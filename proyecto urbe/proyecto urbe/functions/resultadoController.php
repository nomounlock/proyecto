<?php


include "db.php";
require "../vendor/autoload.php";

use Spipu\Html2Pdf\Html2Pdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if($_POST['accion'] == 'update') {

    $resultados = $_POST['resultados'];
    $id_examen = $_POST['id_examen'];
    $id_medico = $_POST['id_medico'];

    try {
        
        $conn = Database::connect();
        $stmt = $conn->prepare('UPDATE resultados SET resultado = ? WHERE id_examen = ? AND id_prueba = ?');

        foreach ($resultados as $resultado) {
            $stmt->bind_param('sii', $resultado['resultado'], $id_examen, $resultado['id_prueba']);
            $stmt->execute();
        }

        $stmt2 = $conn->query('UPDATE examenes SET status = "resultados listos", id_medico = '.$id_medico.' WHERE id = '.$id_examen);

        $conn->close();
        $stmt->close();

        generatePDF(queryPDF($id_examen));

        header('Location: ../lista-examenes.php');
        exit();
        
    } catch (Exception $e) {

        echo 'Error: '.$e->getMessage();
    }
}

function queryPDF($id_examen) {

    try {
        
        $conn = Database::connect();
        $examen = $conn->prepare('SELECT p.nombre, p.correo, p.altura, p.peso, p.fecha_nacimiento, e.fecha, e.id AS id_examen, m.nombre AS medico 
                                    FROM examenes e 
                                    INNER JOIN usuarios p 
                                    ON e.id_usuario = p.id 
                                    INNER JOIN usuarios m 
                                    ON e.id_medico = m.id 
                                    WHERE e.id = ?');
        $examen->bind_param('i', $id_examen);
        $examen->execute();

        $data['examen'] = $examen->get_result()->fetch_array(MYSQLI_ASSOC);

        $examen->close();

        $resultados = $conn->prepare('SELECT r.resultado, p.nombre FROM 
                                    examenes e 
                                    INNER JOIN resultados r 
                                    ON r.id_examen = e.id 
                                    INNER JOIN pruebas p 
                                    ON r.id_prueba = p.id 
                                    WHERE e.id = ?');
        $resultados->bind_param('i', $id_examen);
        $resultados->execute();

        $data['resultados'] = $resultados->get_result()->fetch_all(MYSQLI_ASSOC);

        $resultados->close();

        $conn->close();

        return $data;

    } catch (Exception $e) {
        
        echo 'Error: '.$e->getMessage();
    }
}

function generatePDF($registro) {

    $birth = new DateTime($registro['examen']['fecha_nacimiento']);
    $current = new DateTime("now");

    $edad = intval(date_diff($birth, $current)->format('%Y'));

    ob_start();
    require_once "../resultado-pdf.php";
    $html = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'es', 'true', 'UTF-8');
    $html2pdf->writeHTML($html);

    $pdf_name = 'resultados/resultados_'.$registro['examen']['id_examen'].'_'.$registro['examen']['fecha'].'.pdf';
    $html2pdf->output($_SERVER['DOCUMENT_ROOT'].'medicina/'.$pdf_name, 'F');

    sendEmail($_SERVER['DOCUMENT_ROOT'].$pdf_name, $registro['examen']['correo'], $registro['examen']['fecha']);
}

function sendEmail($file_name, $destinatario, $fecha) {

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try{
        //Configuraciones del servidor
        $mail->IsHTML(true);
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "labmaracaibo.confettipartyshop.cl";
        $mail->Port = 465;
        $mail->Username = "resultados@labmaracaibo.confettipartyshop.cl";
        $mail->Password = "25950164";
        $mail->CharSet = "UTF-8";
        $mail->Encoding = "quoted-printable";
        $fromname = "LAB Maracaibo";
        $email = $destinatario;
        
        $mail->addAttachment($file_name); 
    
        $To = trim($email,"\r\n");
        $tContent   = '';
        $tContent = '<table cellpadding="0" cellspacing="0" border="0" align="center" style="width:600px">   
                    <tbody>
                    <tr>
                    <td width="15" height="85" bgcolor="#FFFFFF">&nbsp;</td>
                    <td width="570" height="85" bgcolor="#FFFFFF">
                    <p style="font-weight:bold;font-family:Arial,sans-serif;font-size:18px;color:#555555">Laboratorio Maracaibo <br> Resultados de Examenes</p>
                    </td>
                    <td width="15" height="85" bgcolor="#FFFFFF">&nbsp;</td>
                    </tr>
                    
                    <tr>
                    <td width="15" height="50" rowspan="3" bgcolor="#FFFFFF">&nbsp;</td>
                    </tr>
                    <tr>
                    <td valign="top" bgcolor="#FFFFFF">
                    <p style="font-family:Arial,sans-serif;font-size:13px;line-height:22px;color:#555555">Resultados del examen realizado el día '.date_format(date_create($fecha), 'd / m / Y').'.</p>
                    </td>
                    </tr>
                    <tr>
                    <td height="75" valign="top" bgcolor="#FFFFFF">
                    <p style="font-family:Arial,sans-serif;font-size:13px;line-height:22px;color:#555555"><br>¡Buen día!</p>
                    </td>
                    </tr>
                    
                    <tr>
                    <td width="15" height="100" rowspan="3" bgcolor="" style="border-top:1px solid #dddddd">&nbsp;</td>
                    <td width="570" height="100" bgcolor="" style="border-top:1px solid #dddddd"><span style="font-family:Arial,sans-serif;font-size:11px;color:#666666">Por favor contacte a su medico una vez revisado sus examenes.<a href="#" style="text-decoration:underline;color:#333333" target="_blank">LAB Maracaibo</a>.</span></td>
                    <td width="15" height="100" rowspan="3" bgcolor="" style="border-top:1px solid #dddddd">&nbsp;</td>
                    </tr>
                    <tr>
                    <td height="50" bgcolor=""><span style="font-family:Arial,sans-serif;font-size:11px;color:#666666">Nuestra dirección: | Maracaibo N°XX | Tlf: +58 412 1234567 | Venezuela </span></td>
                    </tr>
                    </tbody>
                    </table>';
        $mail->From = "resultados@labmaracaibo.confettipartyshop.cl";
        $mail->FromName = 'LAB Maracaibo';        
        $mail->Subject = "Resultados - Laboratorio Maracaibo"; 
        $mail->Body = $tContent;
        $mail->AddAddress($To); 
        $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low
        $mail->Send();

    } catch (Exception $e) {
        echo "Mensaje no enviado. Error: {$mail->ErrorInfo}";
        die();
    }    
}
<page style="font-family: 'Helvetica', sans-serif">
    <h2 style="margin: 0 0 5px;">Laboratorios Maracaibo</h2>
    
    <p style="width: 100%; padding: 3px 5px; margin: 0; margin-bottom: 40px;">
        <span style="width: 30%; margin: 0;">
            <span style="margin: 0; font-size: 12px;">Médico:</span>

            <span style="margin: 0; font-size: 12px; font-weight: 300;"><?= $registro['examen']['medico']; ?></span>
        </span>

        <span style="width: 25%; margin: 0; margin-left: 480px">
            <span style="margin: 0; font-size: 12px;">Fecha:</span>

            <span style="margin: 0; font-size: 12px; font-weight: 300; color: gray"><?= date_format(date_create($registro['examen']['fecha']), 'd / m / Y'); ?></span>
        </span>
    </p>

    <div style="position: relative;">
        <p style="margin: 0; position: absolute; bottom: 0; left: 10px; color: gray; font-size: 12px; font-weight: 300;">Información personal</p>
    </div>

    <div style="border: 1px solid; font-size: 14px; padding: 5px 10px;">
        <p style="width: 100%; margin: 0;">
            <span style="padding: 5px 10px; border-right: 1px solid; width: 50%;">
                <span style="margin: 0;">Nombre: </span>

                <span style="margin: 0 0 0 20px; font-weight: 300; color: gray;"><?= $registro['examen']['nombre']; ?></span>
            </span>

            <span style="padding: 5px 10px; border-right: 1px solid; width: 15%;">
                <span style="margin: 0 0 0 160px;">Edad: </span>

                <span style="margin: 0 0 0 10px; font-weight: 300; color: gray;"><?= $edad ?></span>
            </span>

            <span style="padding: 5px 10px; border-right: 1px solid; width: 20%;">
                <span style="margin: 0 0 0 40px;">Altura: </span>

                <span style="margin: 0 0 0 10px; font-weight: 300; color: gray;"><?= $registro['examen']['altura']; ?> cm</span>
            </span>

            <span style="padding: 5px 10px; width: 15%;">
                <span style="margin: 0 0 0 40px;">Peso: </span>

                <span style="margin: 0 0 0 10px; font-weight: 300; color: gray;"><?= number_format($registro['examen']['peso'], 2); ?> Kg</span>
            </span>
        </p>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
        <thead style="font-size: 14px;">
            <tr>
                <th style="text-align: center; padding-bottom: 12px; font-weight: 500; width: 50%;">Prueba</th>

                <th style="text-align: center; padding-bottom: 12px; font-weight: 500; width: 50%;">Resultado</th>
            </tr>
        </thead>

        <tbody style="font-size: 12px;">
            <?php foreach($registro['resultados'] as $resultado) : ?>
                <tr>
                    <td style="text-align: center; padding: 5px 0 7px; border-top: 1px solid gray;"><?= $resultado['nombre']; ?></td>

                    <td style="text-align: center; padding: 5px 0 7px; border-top: 1px solid gray; font-weight: 300; color: gray;"><?= $resultado['resultado']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</page>
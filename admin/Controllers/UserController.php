<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once 'library/PhpSpreadsheet/vendor/autoload.php';

require_once 'library/Controllers.php';

class UserController extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Index($page = 0)
    {
        if (null != Session::getSession("nombre")) {
            $filter = (isset($_GET["filtrar"])) ? $_GET["filtrar"] : "";
            $registrosPorPagina = (isset($_GET["registrosPorPagina"])) ? $_GET["registrosPorPagina"] : 5;

            // Obtener rango de fechas (opcional)
            $fechaInicio = (isset($_GET["date1"])) ? $_GET["date1"] : null;
            $fechaFin = (isset($_GET["date2"])) ? $_GET["date2"] : null;

            $response = $this->model->GetUsers(
                $this->paginador,
                $filter,
                $page,
                $registrosPorPagina,
                "User/Index",
                URL,
                $fechaInicio,
                $fechaFin
            );

            if (is_array($response)) {
                if (!(0 < count($response["results"]))) {
                    $response = array(
                        "results" => null,
                        "pagi_info" => null,
                        "pagi_navegacion" => "No hay datos que mostrar"
                    );
                }
            } else {
                $response = array(
                    "results" => null,
                    "pagi_info" => null,
                    "pagi_navegacion" => $response
                );
            }
            $this->view->Render($this, "user", $response, null, null);
        } else {
            header("Location:" . URL);
        }
    }


    public function Details($id)
    {
        if (null != Session::getSession("nombre")) {
            $response = $this->model->GetUsers(
                null,
                $id,
                null,
                null,
                null,
                null,
                null,
                null
            );
            if (is_array($response)) {
                if (0 < count($response["results"])) {
                    $this->view->Render($this, "details", $response["results"], null, null);
                } else {
                    header('Location: User');
                }
            } else {
                header('Location: User');
            }
        } else {
            header("Location:" . URL);
        }
    }


    public function ExportExcel()
    {
        // Verificar si el usuario tiene sesión iniciada
        if (null != Session::getSession("nombre")) {

            // Obtener rango de fechas (opcional)
            $fechaInicio = (isset($_GET["date1"])) ? $_GET["date1"] : null;
            $fechaFin = (isset($_GET["date2"])) ? $_GET["date2"] : null;
            
            // Obtener datos de usuarios desde el modelo
            $response = $this->model->UserExport($fechaInicio, $fechaFin);
            // Verificar si se obtuvieron datos de usuarios correctamente
            //if (is_array($response)) {
                //if (0 < count($response["results"])) {
                    // Crear instancia de la clase Spreadsheet
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();


                    // Establecer estilo de borde y alineación para los encabezados
                    $headerStyle = [
                        'font' => ['bold' => true],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN
                            ]
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER, // Alinear horizontalmente al centro
                            'vertical' => Alignment::VERTICAL_CENTER, // Alinear verticalmente al centro
                        ],
                    ];
                    // Escribir encabezados de las columnas
                    $sheet->setCellValue('A1', 'ID');
                    $sheet->setCellValue('B1', 'Nombre completo');
                    $sheet->setCellValue('C1', 'Tipo de documento');
                    $sheet->setCellValue('D1', 'Número de documento');
                    $sheet->setCellValue('E1', 'Fecha de creación');
                    $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);
                    $sheet->getStyle('A1:E1')->getFont()->setBold(true);

                    // Establecer ancho personalizado para las columnas
                    $sheet->getColumnDimension('A')->setWidth(4);
                    $sheet->getColumnDimension('B')->setWidth(35);
                    $sheet->getColumnDimension('C')->setWidth(19);
                    $sheet->getColumnDimension('D')->setWidth(21);
                    $sheet->getColumnDimension('E')->setWidth(17.50);


                    // Establecer estilo de borde y alineación para las celdas
                    $cellStyle = [
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN
                            ]
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER, // Alinear horizontalmente a la izquierda
                            'vertical' => Alignment::VERTICAL_CENTER, // Alinear verticalmente al centro
                        ],
                    ];

                    // Escribir datos de usuarios en las filas
                    $row = 2;
                    foreach ($response["results"] as $user) {
                        $sheet->setCellValue('A' . $row, $user['id'])->getStyle('A' . $row)->applyFromArray($cellStyle);
                        $sheet->setCellValue('B' . $row, $user['full_name'])->getStyle('B' . $row)->applyFromArray($cellStyle);;
                        $sheet->setCellValue('C' . $row, $user['document_type'])->getStyle('C' . $row)->applyFromArray($cellStyle);;
                        $sheet->setCellValueExplicit('D' . $row, $user['document_number'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING)->getStyle('D' . $row)->applyFromArray($cellStyle);;
                        $sheet->setCellValue('E' . $row, $user['created_at'])->getStyle('E' . $row)->applyFromArray($cellStyle);;
                        $row++;
                    }

                    // Crear objeto de escritura en formato Xlsx
                    $writer = new Xlsx($spreadsheet);

                    // Obtener la fecha y hora actual
                    $currentDateTime = date('Y-m-d_H.i.s');

                    // Concatenar la fecha y hora al nombre del archivo
                    $filename = "users_" . $currentDateTime . ".xlsx";

                    // Configurar encabezados de respuesta para descargar el archivo
                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

                    // Configurar el encabezado Content-Disposition con el nombre del archivo
                    header('Content-Disposition: attachment;filename="' . $filename . '"');

                    header('Cache-Control: max-age=0');

                    // Guardar archivo en el buffer de salida y descargarlo
                    $writer->save('php://output');

                    // Finalizar ejecución para evitar renderizar la vista
                    exit();
                //} else { header('Location: User'); }
            //} else { header('Location: User');}
        } else {
            header("Location:" . URL);
        }
    }
}

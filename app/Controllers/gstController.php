<?php

namespace App\Controllers;
    use App\Models\UserModel;
    use App\Models\AgentModel;
    use App\Models\StaffModel;
    use App\Models\Paymentmodel;
    use App\Models\EmiModel;
    use App\Models\NumberofScheme;
    use App\Models\GenerateInvoiceModel;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Writer\Exception;

    use DateTime; 
    
    use COdeigniter\Controller;
    
   
   
    // Add the correct model here
    
        


    class gstController extends BaseController
    {
    public  function __construct()
    {
        
        helper(['url','form']);
        $this->model = new GenerateInvoiceModel();
    }
    public function gstreport()
    {   
        $data['pageTitle']='GST Report';
        return view('pages/gst-report',$data);
    }
    
    
    
    public function exportToExcel()
    {
        try {
            $fromDate = $this->request->getVar('fromDate');
            $toDate = $this->request->getVar('toDate');

            $generateInvoiceModel = new GenerateInvoiceModel(); // Instantiate the model
            $data = $generateInvoiceModel->getDataBetweenDateExport($fromDate, $toDate);

            if (!empty($data)) {
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                $sheet->setCellValue('A1', 'Sno.');
                $sheet->setCellValue('B1', 'Invoice No');
                $sheet->setCellValue('C1', 'Agent Id');
                $sheet->setCellValue('D1', 'Agent Name');
                $sheet->setCellValue('E1', 'CGST');
                $sheet->setCellValue('F1', 'SGST');
                $sheet->setCellValue('G1', 'IGST');
                $sheet->setCellValue('H1', 'TDS');
                $sheet->setCellValue('I1', 'GST Number');

                // Add data rows
                $row = 2;
                $index = 1;

                foreach ($data as $item) {
                    $sheet->setCellValue('A' . $row, $index);
                    $sheet->setCellValue('B' . $row, $item['invoice_no']);
                    $sheet->setCellValue('C' . $row, $item['agent_id']);
                    $sheet->setCellValue('D' . $row, $item['agentName']);
                    $sheet->setCellValue('E' . $row, $item['cgst']);
                    $sheet->setCellValue('F' . $row, $item['sgst']);
                    $sheet->setCellValue('G' . $row, $item['igst']);
                    $sheet->setCellValue('H' . $row, $item['tds']);
                    $sheet->setCellValue('I' . $row, $item['gst_no']);
                    $row++;
                    $index++;
                }

                $writer = new Xlsx($spreadsheet);

                // Set the response headers to trigger a download
                $filename = 'GST_Report_' . date('Y-m-d_H:i:s') . '.xlsx';
                $writer->save('php://output'); // Output the file directly

                // Download the file
                $response = service('response');
                $response->setHeader('Content-Type', 'application/vnd.ms-excel');
                $response->setHeader('Content-Disposition', 'attachment;filename="' . $filename . '"');
                $response->setHeader('Cache-Control', 'max-age=0');
            } else {
                return $this->response->setJSON(['error' => 'No data found between the selected dates.']);
            }
        } catch (\Exception $e) {
            // Handle or log the exception here
            return $this->response->setJSON(['error' => $e->getMessage()]);
        }
    }

    

// public function exportToExcel()
//     {
//         try{
//             $fromDate = $this->request->getVar('fromDate');
//         $toDate = $this->request->getVar('toDate');

//         $this->model = new GenerateInvoiceModel();
//         $data = $this->model->getDataBetweenDate($fromDate, $toDate);

//         if (!empty($data)) {
//             $spreadsheet = new Spreadsheet();
//             $sheet = $spreadsheet->getActiveSheet();

//             // Add headers
//             $sheet->setCellValue('A1', 'Sno.');
//             $sheet->setCellValue('B1', 'Invoice No');
//             $sheet->setCellValue('C1', 'Agent Id');
//             $sheet->setCellValue('D1', 'Agent Name');
//             $sheet->setCellValue('E1', 'CGST');
//             $sheet->setCellValue('F1', 'SGST');
//             $sheet->setCellValue('G1', 'IGST');
//             $sheet->setCellValue('H1', 'TDS');
//             $sheet->setCellValue('I1', 'GST Number');

//             // Add data rows
//             $row = 2;
//             $index = 1;
//             // echo $data;
//             foreach ($data as $item) {
//                 $sheet->setCellValue('A' . $row, $index);
//                 $sheet->setCellValue('B' . $row, $item['invoice_no']);
//                 $sheet->setCellValue('C' . $row, $item['agent_id']);
//                 $sheet->setCellValue('D' . $row, $item['agentName']);
//                 $sheet->setCellValue('E' . $row, $item['cgst']);
//                 $sheet->setCellValue('F' . $row, $item['sgst']);
//                 $sheet->setCellValue('G' . $row, $item['igst']);
//                 $sheet->setCellValue('H' . $row, $item['tds']);
//                 $sheet->setCellValue('I' . $row, $item['gst_no']);
//                 $row++;
//                 $index++;
//             }

//             // Create the Excel file
//             $writer = new Writer\Xlsx($spreadsheet);

//             // Set the response headers to trigger a download
//             $filename = 'GST_Report_' . date('Y-m-d_H:i:s') . '.xlsx';
//             $writer->saveToFile(WRITEPATH . 'excel/' . $filename);
//             return $this->response->download(WRITEPATH . 'excel/' . $filename, null)->setFileName($filename);
//         } else {
//             return $this->response->setJSON($data);
//         }
//         }
//         catch(err){
//             return $this->response->setJSON(err);
//         }
//     }

    
    public function comparedates()
{
    $fromDate = $this->request->getVar('fromDate');
    $toDate = $this->request->getVar('toDate');

    $model = new GenerateInvoiceModel();
    $dataWithTotalTDS = $model->getDataBetweenDate($fromDate, $toDate);

    if (!empty($dataWithTotalTDS['rows'])) {
        $response = [
            'rows' => $dataWithTotalTDS['rows'],
            'totalTDS' => $dataWithTotalTDS['totalTDS'],
        ];
        return $this->response->setJSON($response);
    } else {
        return $this->response->setJSON([]); // Handle no data found as needed
    }
}

            }
    
    ?>
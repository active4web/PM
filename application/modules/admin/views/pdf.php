<?php 
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('My Title');
$pdf->SetHeaderMargin(30);
$pdf->SetTopMargin(20);
$pdf->setFooterMargin(20);
$pdf->SetAutoPageBreak(true);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');
$pdf->setRTL(true);
$pdf->SetFont('aealarabiya', '', 18);
$pdf->AddPage();

$tbl = <<<EOD
<span color="#0000ff"> "العربية" </span>
<h1>Islam</h1>
<table border="1">
<tr>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
<th>Heading Column Span </th>
</tr>
<tr>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
<td>1111111111</td>
</tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->Output('My-File-Name.pdf', 'I');
?>
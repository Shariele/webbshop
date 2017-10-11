<?php
require "../lib/FPDF/fpdf.php";

 


class PDF extends FPDF
{

    var $B;
    var $I;
    var $U;
    var $HREF;

    function PDF($orientation='P', $unit='mm', $size='A4'){
        // Call parent constructor
        $this->FPDF($orientation,$unit,$size);
        // Initialization
        $this->B = 0;
        $this->I = 0;
        $this->U = 0;
        $this->HREF = '';
    }
    function get_data(){
        include "../include/connect_db.php";

        $id = $_GET['id']; 

        $order_id = 0;
        $article_id = "";
        $article = "";
        $quantity = "";
        $price = "";
        $tot_price = "";
        $email = "";
        $full_name = "";
        $residental_address = "";
        $zip_code = "";
        $country = "";
        $mobile_number = "";
        $city = "";
        $region = "";
        $time = "";

        $data = array();

        $sql = "SELECT * FROM shipping WHERE order_id=$id";
        $sth = $pdo->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();
        foreach($result as $row){
            $data[0] = $row['full_name'];
            $data[1] = $row['email'];
            $data[2] = $row['country'];
            $data[3] = $row['region'];
            $data[4] = $row['city'];
            $data[5] = $row['residental_adress'];
            $data[6] = $row['zip_code'];
            $data[7] = $row['mobile_number'];
            $data[8] = $row['time'];
            $data[9] = $row['order_id'];
            $data[10] = $row['article_id'];
            $data[11] = $row['article_name'];
            $data[12] = $row['quantity'];
            $data[13] = $row['price'];
            $data[14] = $row['tot_price'];
            
        }

        return $data;
    }

    function OpenTag($tag, $attr){
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
    }

    function SetStyle($tag, $enable){
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function CloseTag($tag){
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function PutLink($URL, $txt){
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }

        // Simple table
    function content($data)
    {
        /*-----Header-----*/

        // Logo
        //$this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,"Order list for order: ".$data[9]."");
        // Line break
        $this->Ln(20);

        /*-----end of header-----*/

        $text = array(
            "Name: ",
            "Email: ",
            "Country: ",
            "Region: ",
            "City: ",
            "Residental address: ",
            "Zip code: ",
            "Mobile number: ",
            "Time ordered: "
        );

        $this->SetFont('Arial','B',12);
        $this->Cell(30,10,"Customer information:");
        $this->Ln(10);

        for($i = 0; $i < count($text); $i++){
            $this->SetFont('Arial','B',10);
            $this->Cell(40,10,$text[$i]);
            $this->SetFont('Arial','',10);
            $this->Cell(60,10,$data[$i]);
            $this->Ln(5);
        }

        $this->Ln(15);

        $this->SetFont('Arial','B',12);
        $this->Cell(30,10,"Products:");
        $this->Ln(10);


        $articles = array();
        for($i = 0; $i < 4; $i++){
            $articles[$i] = $data[$i+10];
        }

        $w = array("Article id: ", "Article name: ", "Quantity: ", "Price: ");
        // Data
        $this->SetFont('Arial','B',10);
        for($i=0; $i < count($w); $i++){
            $this->Cell(47,10,$w[$i],1,0,'C');
        }
        $this->Ln();

        $string = "";
        $x=$this->GetX();
        $y=$this->GetY();

        $this->Ln(10);
        $this->SetXY($x,$y);
        $this->MultiCell(47,10,$articles[0],0,'C');
        $this->SetXY($x+47,$y);
        $this->MultiCell(47,10,$articles[1],0,'C');
        $this->SetXY($x+94,$y);
        $this->MultiCell(47,10,$articles[2],0,'C');
        $this->SetXY($x+141,$y);
        $this->MultiCell(47,10,$articles[3],0,'C');
        //$this->Ln(10);
        //$this->SetXY($x+141,$y);
        $this->MultiCell(191,10,"Total price: ".$data[14]." Kr",0,'R');
        $this->Cell(0,0,'','T');
        
        
        

        /*for($i = 0; $i < 4; $i++){
            
        }*/

        /*$this->SetFont('Arial','B',10);
        for($i=0; $i < count($w); $i++){
            $this->Cell(47,10,$w[$i],1,0,'C');
        }
        $this->Ln();*/

        
        /*$this->MultiCell(47,10,$articles[0],'LR','C');
        $this->MultiCell(47,10,$articles[1],'LR','C');
        $this->Cell(47,10,$articles[2],'LR',0,'J');
        $this->Cell(47,10,$articles[3],'LR',0,'J');
        $this->Ln();*/
        /*for($n = 0; $n < 4; $n++){
            $html = "";
            $html = $articles[$n];   

            // HTML parser
            $html = str_replace("\n",' ',$html);
            $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
            foreach($a as $i=>$e)
            {
                if($i%2==0)
                {
                    // Text
                    if($this->HREF)
                        $this->PutLink($this->HREF,$e);
                    else
                        //$this->Write(15,$e);
                        $this->Cell(50,10,$e);
                }
                else
                {
                    // Tag
                    if($e[0]=='/')
                        $this->CloseTag(strtoupper(substr($e,1)));
                    else
                    {
                        // Extract attributes
                        $a2 = explode(' ',$e);
                        $tag = strtoupper(array_shift($a2));
                        $attr = array();
                        foreach($a2 as $v)
                        {
                            if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                                $attr[strtoupper($a3[1])] = $a3[2];
                        }
                        $this->OpenTag($tag,$attr);
                    }
                }
            }
        }*/


        // Closing line
        //$this->Cell(array_sum($w),0,'','T');    

    

    }

    // Page footer
    function Footer(){
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

    // Instanciation of inherited class
    $pdf = new PDF();

    $data = $pdf->get_data();

    //$pdf->SetAutoPageBreak(false);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->content($data);
    $pdf->Output();
?>
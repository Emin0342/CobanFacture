<?php 
  require ("fpdf.php");
  require ("word.php");
  require "config.php"; 

  //customer and invoice details
  $info=[
    "customer"=>"",
    "address"=>",",
    "city"=>"",
    "devis_no"=>"",
    "devis_date"=>"",
    "total_amt"=>"",
    "words"=>"",
  ];
  
  //Select Invoice Details From Database
  $sql="select * from devis where SID='{$_GET["id"]}'";
  $res=$con->query($sql);
  if($res->num_rows>0){
	  $row=$res->fetch_assoc();
	  
	  $obj=new IndianCurrency($row["GRAND_TOTAL"]);
	 

	  $info=[
		"customer"=>$row["CNAME"],
		"address"=>$row["CADDRESS"],
		"city"=>$row["CCITY"],
		"devis_no"=>$row["DEVIS_NO"],
		"devis_date"=>date("d-m-Y",strtotime($row["DEVIS_DATE"])),
		"total_amt"=>$row["GRAND_TOTAL"],
		"words"=> $obj->get_words(),
	  ];
  }
  
  //devis Products
  $products_info=[];
  
  //Select devis Product Details From Database
  $sql="select * from devis_products where SID='{$_GET["id"]}'";
  $res=$con->query($sql);
  if($res->num_rows>0){
	  while($row=$res->fetch_assoc()){
		   $products_info[]=[
        "name"=>$row["PNAME"],
        "price"=>$row["PRICE"],
        "qty"=>$row["QTY"],
        "metre"=>$row["METRE"],
        "total"=>$row["TOTAL"],
		   ];
	  }
  }
  
  class PDF extends FPDF
  {
    function Header(){

// Position du logo (en millimètres)
$logoX = 5;
$logoY = 7;

// Largeur et hauteur du logo (en millimètres)
$logoWidth = 29;
$logoHeight = 0;

// Ajouter le logo à la page
$this->Image('logo.png', $logoX, $logoY, $logoWidth, $logoHeight, '', '', 'T', false, 300, 'L', false, false, 0, false, false, false);

//Display Company Info
$this->SetFont('Arial','B',14);
$this->SetXY(40, 5); // Modifier la valeur en fonction de la position souhaitée
$this->Cell(50,10,"COBAN Plaquiste",0,1);
$this->SetFont('Arial','',12);
$this->SetXY(40, 15); // Modifier la valeur en fonction de la position souhaitée
$this->Cell(50,5,"Rue de la chaux",0,1);
$this->SetFont('Arial','',12);
$this->SetXY(40, 20); // Modifier la valeur en fonction de la position souhaitée
$this->Cell(50,5,"Andrezieux Bouth\xE9on",0,1);
$this->SetFont('Arial','',12);
$this->SetXY(40, 25); // Modifier la valeur en fonction de la position souhaitée
$this->Cell(50,5,"42160",0,1);
$this->SetFont('Arial','',12);
$this->SetXY(40, 30); // Modifier la valeur en fonction de la position souhaitée
$this->Cell(50,5,"cobanplaterie@gmai.com",0,1); // Ajouter l'e-mail
$this->SetFont('Arial','',12);
$this->SetXY(40, 35); // Modifier la valeur en fonction de la position souhaitée
$this->Cell(50,5,"07 70 27 55 11",0,1); // Ajouter le numéro de téléphone


//Display Horizontal line
$this->Line(0,48,210,48);
    }
    
    function body($info,$products_info){
      
      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12,);
      $this->Cell(50,10,"Client : ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["customer"],0,1);
      $this->Cell(50,7,$info["address"],0,1);
      $this->Cell(50,7,$info["city"],0,1);
      
      //Display devis no
      $this->SetY(55);
      $this->SetX(-60);
      $this->Cell(50,7,"Devis n\xB0 ".$info["devis_no"]);
      
      //Display devis date
      $this->SetY(63);
      $this->SetX(-60);
      $this->Cell(50,7,"Date du devis : ".$info["devis_date"]);

      $this->SetY(70);
      $this->SetX(-60);
      $this->Cell(50,7,"DEVIS EN EURO");
      
         //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(115,9,"D\xE9signation",1,0);
      $this->Cell(15,9,"Unite",1,0,"C");
      $this->Cell(20,9,"PU",1,0,"C");
      $this->Cell(20,9,"QTE",1,0,"C");
      $this->Cell(25,9,"TOTAL",1,1,"C");
      $this->SetFont('Arial','',12);
      
      //Display table product rows
      foreach($products_info as $row){
        $this->Cell(115,9,$row["name"],"LR",0);
        $this->Cell(15,9,$row["metre"],"R",0,"C"); // Nouvelle colonne "Unité"
        $this->Cell(20,9,$row["price"],"R",0,"R");
        $this->Cell(20,9,$row["qty"],"R",0,"C");
        $this->Cell(25,9,$row["total"],"R",1,"R");
      }
      //Display table empty rows
      for($i=0;$i<12-count($products_info);$i++)
      {
        $this->Cell(115,9,"","LR",0);
        $this->Cell(15,9,"","R",0,"R");
        $this->Cell(20,9,"","R",0,"R");
        $this->Cell(20,9,"","R",0,"C");
        $this->Cell(25,9,"","R",1,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(170,9,"TOTAL",1,0,"R");
      $this->Cell(25,9,$info["total_amt"].'',1,1,"R");
      
      
    }
    function Footer(){
      
      // Set footer position
$this->SetY(-60);
$this->SetFont('Arial','B',12);
$this->Ln(15);
$this->SetFont('Arial','',12);

// Écrire la première cellule de texte
$this->Cell(0,3,"Signature Vendeur",0,9,"R");

// Obtenir la position x actuelle
$x = $this->GetX();

// Écrire la deuxième cellule de texte en utilisant la même position x
$this->SetXY($x, $this->GetY());
$this->Cell(0,3,"Signature Client",0,9,"L");

$this->SetFont('Arial','',10);
      
      
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $pdf_name = "Devis n\xB0" . $info["devis_no"] . '_' . $info["customer"] . '.pdf';
  $pdf->Output($pdf_name, 'I');
?>
<?php
require 'includes/dbhandler.inc.php';

$sql = "SELECT StatusID, StatusName FROM BlotterStatus_tbl";
$result = $conn->query($sql);
$statusOptions = '';

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $statusOptions .= "<option value='" . $row['StatusID'] . "'>" . $row['StatusName'] . "</option>";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Blotter Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="adminfiles/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="adminfiles/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="adminfiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="adminfiles/dist/css/ogcss.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="shortcut icon" href="builtimages/left_logo.png" type="image/x-icon">  
</head>
<style>
  .card-info:not(.card-outline) .card-header {
    background-color: #232743;
  }

  .row {
    margin-left: 10px;
    margin-right: 10px;
  }

  .card-primary.card-outline {
    border-top: 3px solid #232743;
  }

  .custom-alert {
    color: #31708f;
    background-color: #d9edf7;
    border-color: #bce8f1;
  }

  @media print
  {   
    body {-webkit-print-color-adjust: exact;}

    .no-print, .no-print *
    {
     display: none !important;
   }

   .no-print-required, .no-print-required *
   {
     display: none !important;
   }
 }

 table td {max-height: 20px;}

.table {
    width: 100%;
    margin-bottom: 0px;
    color: #212529;
    background-color: transparent;
}


 select, input {background-color:#D6E6F4;border:0;}
 .element-white {background-color:#fff;border:0;}
 #foto {cursor: pointer;}
 .titulo {background-color:#232743;font-weight:700; line-height: 35px}
 textarea
 {
   border: 1px solid #c3c3c3;             
   resize: none;             
   overflow-x: hiden;
   height: 30px;
 }

 select{
  border: 0 !important;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  text-overflow:'';
  text-indent: 0.01px;
  font-style: italic;
}
select::-ms-expand {
  display: none;
}
.select-wrapper
{
  padding-left:0px;
  overflow:hidden;              
}

</style>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user-circle fa-2x"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <span class="dropdown-item dropdown-header"> Hello, user! </span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" style="text-align: center;">
              <i class="fas fa-user"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="includes/logout.inc.php" class="dropdown-item" style="text-align: center;">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="builtimages/left_logo.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Barangay 731</a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview menu-open">
              <a href="../AdminDashboard.php" class="nav-link active">
                <i class="fas fa-chart-line nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../adminProfile.php" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
                <p>Profile</p>
              </a>
            </li>
            <li class="nav-header">Main Navigation</li>
            <li class="nav-item">
              <a href="UsersList.php" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Users Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../VerificationPage.php" class="nav-link">
                <i class="fas fa-user-check nav-icon"></i>
                <p>Verification Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../barangayOfficials.php" class="nav-link">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>Barangay Officials Page</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>
                  Inhabitants
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../ResidentsList.php" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <p>Residents List</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../householdList.php" class="nav-link">
                    <i class="fas fa-home nav-icon"></i>
                    <p>Household List</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">Manage Records</li>
            <li class="nav-item">
              <a href="../viewRequests.php" class="nav-link">
                <i class="fas fa-file-alt nav-icon"></i>
                <p>Documents Requesting</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../viewBlotterRecords.php" class="nav-link">
                <i class="fas fa-clipboard nav-icon"></i>
                <p>Blotter Records</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>


      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-2">
            <div class="card">
              <div class="alert custom-alert alert-dismissible fade show" role="alert">
                Include the date and time of the incident, location, detailed description, names and details of involved individuals, reporting officer's information, any witness statements, and actions taken or to be taken.
                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> -->
            </div>
          </div>
        </div>
        <!-- Start form -->
        <div class="col-md-10">
          <!-- Horizontal Form -->
          <div class="card card-info">
            <!-- form start -->
            <div class="card-body">

              <div class="col-12 mt-3">
               <div class="text-white text-center d-block mb-1"><h4 class="titulo pb-2 pt-2">Blotter Form</h4></div>
               <div class="mb-2 pl-2 text-white d-block titulo">RELATÓRIO MÉDICO</div>
               <table class="table table-sm">
                <tbody>
                 <tr>
                  <td class="w-25 text-center" style="border-right:1px #41719C solid;border-top:5px #41719C solid">Paciente <span class="text-danger">*</span></td>
                  <td colspan="3" class="w-75" style="background-color:#D6E6F4;border-top:5px #41719C solid;border-right:1px #41719C solid;">
                   <input type="text" name="paciente" id="paciente" class="w-100 no-print-required">
                 </td>
               </tr>
               <tr>
                <td style="width:200px;border-right:1px #41719C solid;" class="text-center">Data de Nascimento <span class="text-danger">*</span></td>
                <td>
                 <input type="date" name="dtNascimento" id="dtNascimento" class="w-100 element-white no-print-required">
               </td>
               <td class="text-right">Número de Atendimento <span class="text-danger">*</span></td>
               <td style="border-right:1px #41719C solid;"><input type="text" name="nrAtendimento" id="nrAtendimento" class="w-100 no-print-required element-white"></td>
             </tr>
             <tr>
              <td style="width:200px;border-right:1px #41719C solid;" class="text-center">Médico Solicitante <span class="text-danger">*</span></td>
              <td style="background-color:#D6E6F4;">
               <input type="text" name="medicoSolicitante" id="medicoSolicitante" class="w-100 no-print-required">
             </td>
             <td style="background-color:#D6E6F4;" class="text-right">C.R.M. <span class="text-danger">*</span></td>
             <td style="border-right:1px #41719C solid;background-color:#D6E6F4; "><input type="text" name="crm" id="crm" class="w-100 no-print-required"></td>
           </tr>
           <tr>
            <td style="width:200px;border-right:1px #41719C solid;" class="text-center" >1 - Diagnóstico <span class="text-danger">*</span></td>
            <td colspan="3" style="border-right:1px #41719C solid;">
             <div class="select-wrapper">
              <select name="diagnostico" id="diagnostico" style="border:0;white-space:pre-wrap;white-space:-moz-pre-wrap; " class="w-100 element-white no-print-required">
               <option class="no-print">Escolher ‣</option>
               <option>C82 - Linfona não-Hodgkin, folicular (nodular)</option>
               <option>C83 - Linfona não-Hodgkin difuso</option>
               <option>C84 - Linfomas de células T cutâneas e periféricas</option>
             </select>                               
           </div>
         </td>
       </tr>
       <tr>
        <td style="width:200px;border-right:1px #41719C solid;" class="text-center" >2 - Procedimento Autorizado <span class="text-danger">*</span></td>
        <td colspan="3" style="background-color:#D6E6F4;border-right:1px #41719C solid;">
         <div class="select-wrapper">
          <select name="procedimento" id="procedimento" style="border:0;white-space:pre-wrap;white-space:-moz-pre-wrap; " class="w-100 no-print-required">
           <option class="no-print">Escolher ‣</option>
           <option>0303020032 - Tratamento de anemia aplástica e outras anemias</option>
           <option>0304080039 - Internação para quimioterapia de leucemias agudas/crônicas agudizadas</option>
         </select>                           
       </div>
     </td>
   </tr>                    
</tbody>
</table>
</div>
</div>
<div class="mb-2 pl-2 text-white d-block titulo">4 - DOCUMENTOS PARA ATESTAR A INFECÇÃO</div>
<div class="row">
  <div class="col-12 mb-3">
   <div class="select-wrapper">
    <h6>DOENÇA FÚNGICA INVASIVA COMPROVADA <span class="text-danger">*</span> <small class="no-print">(Pelo menos um dos seguintes documentos deve ser anexado ao relatório)</small></h6>
                                              
 </div>                                   
</div>
<div class="col-12 mb-3">
 <div class="select-wrapper">
  <h6>DOENÇA FÚNGICA INVASIVA PROVÁVEL <span class="text-danger">*</span> <small class="no-print">(Pelo menos um dos seguintes documentos deve ser anexado ao relatório)</small></h6>
                                              
</div>                                   
</div>            
</div>         
<div class="mb-2 pl-2 text-white d-block titulo">5 - ESQUEMA POSOLÓGICO</div>
<div class="row">
  <div class="col-4">
   <div class="select-wrapper">
    <h6>MEDICAMENTO <span class="text-danger">*</span></h6>
    <select id="medicamento" name="medicamento" style="border:0;white-space:pre-wrap;white-space:-moz-pre-wrap;" class="w-100 element-white no-print-required">
     <option class="no-print">Escolher ‣</option>
     <option>Voriconazol 200mg</option>
   </select>                                               
 </div>                                   
</div>
<div class="col-4">
 <div class="select-wrapper">
  <h6>POSOLOGIA <span class="text-danger">*</span></h6>
                                             
</div>                                   
</div>            
<div class="col-4">

</div>
</div>          
<div class="row mt-3 mb-3">
  <div class="col-12">

 </div>
</div>         
<div class="row mt-3 mb-3">
  <div class="col-12">

 </div>
</div>         
<div class="row mt-3 mb-3">
  <div class="col-12">

 </div>
</div>         
        
<div class="row mt-3 mb-3">
  <div class="col-12">
   <div class="alert alert-danger mb-2 text-center d-none" id="msgValidaForm" role="alert">
     Você deve preencher <strong>todos os campos</strong> para realizar a impressão!
   </div>                              
   <button class="btn btn-primary w-100 no-print" id="btnPrint">Imprimir Documento</button>
 </div>
</div>         




</div>
</div>
<!-- /.card -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>

<script src="adminfiles/plugins/jquery/jquery.min.js"></script>
<script src="adminfiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminfiles/dist/js/adminlte.min.js"></script>

</body>
</html>
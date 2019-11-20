<!DOCTYPE html>
<html lang="en-US">
   <head>
   <title class="notranslate">Subtitle Translator v1.0.3 | By Antidote</title>
      <link rel="stylesheet" href="lib/css/bootstrap.min.css">
      <link rel="stylesheet" href="lib/css/style.css">
      <link rel="shortcut icon" href="lib/img/favicon.png" type="image/png">
      <meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
   <body>
      <div class="container" style="padding-top:20px;padding-bottom:10px;">
         <div class="row">
            <div class="col-sm"></div>
            <div class="col-sm">
               <img  class="img-fluid" src="lib/img/banner.png">
            </div>
            <div class="col-sm"></div>
         </div>
         <!-- end row -->
      </div>
      <!-- end container -->
      <div class="container" style="padding-top:10px;padding-bottom:10px;">
         <div  class="row">
            <div class="col-sm-6 col-md-6">
               <div class="notranslate  card border-dark">
                  <div class="card-header" align="center">Subtitle Settings</div>
                  <div class="card-body">
                     <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Select Subtitle:</label>
                        <div class="col-sm-6">
                           <select id="subtitle_select" class="form-control form-control-sm">
                              <option value="1">- Select Subtitle -</option>
                           </select>
                        </div>
                        <!-- end col  5 -->
                        <div class="col-sm-3">
                           <button type="button" id="btn_subtitle_slct" class="btn btn-info btn-sm">Select</button>
                        </div>
                        <!-- end col 4 -->               
                     </div>
                     <!-- end form group -->
                  </div>
                  <!-- end card body -->
               </div>
               <!-- end card -->
            </div>
            <!-- col 6  -->
            <div class="col-sm-6 col-md-6">
               <div class="notranslate  card border-dark" >
                  <div class="card-header" align="center">Subtitle Folder Settings</div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm"  align="center">
                           <button type="submit" id="Btn_Clean" class="btn btn-danger btn-sm">Clean Folder</button>
                        </div>
                        <div class="col-sm"  align="center">
                           <button type="button" data-toggle="modal" data-target="#UploadModal" class="btn btn-success btn-sm">Upload Subtitles(Zip)</button>
                        </div>
                     </div>
                  </div>
                  <!-- end card body -->
               </div>
               <!-- end card -->
            </div>
            <!-- col 6  -->
         </div>
         <!-- row    -->
      </div>
      </div>
      <!-- end row -->
      <div class="container">
      <div class="row">
      <div class="col-sm-6 col-md-6">
            <div class="notranslate  card border-dark" >
               
               <div class="card-header notranslate"> 
               <div class="row">
                     <div class="col-sm-12"><pre>Original Subtitle</pre></div>
                   
                  
                  </div>
              
               </div>
         
               <div class="card-body">
                  <pre id="original_txt" class="notranslate"></pre>
                  <!-- here subtitle  -->
               </div>
            </div>
            </div>
            <div class="col-sm-6 col-md-6">
            <div class="card border-dark" >
               <div class="card-header">
                  <div class="row">
                     <div class="col-sm-7 notranslate"><pre>Translated Subtitle | Target Language:</pre></div>
                     <div class="col-sm-2" >
                        <div id="google_translate_element"   style="padding-right:0px;"></div>
                     </div>
                     <div class="col-sm-3 notranslate">
                        <button type="button" id="saveBtn" class="btn btn-warning btn-sm">Save</button>
                     </div>
                  </div>
                  <!-- row -->
               </div>
               <div class="card-body">
                  <pre id="subtitle_txt" ></pre>
                  <!-- here subtitle  -->
               </div>
            </div>
         </div>
      </div>
      <!-- Modal -->
      <div class="notranslate modal fade" id="UploadModal" tabindex="-1" role="dialog" aria-labelledby="UploadModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <p  class="modal-title" id="UploadModalLabel">Remote Upload Form</p>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form id="uploadForm" enctype="multipart/form-data">
                     <div class="row">
                        <div class="col-md-9">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input" name="file" id="file">
                              <input type="hidden" name="method" value="uploadfile" >
                              <label class="custom-file-label" for="file">Choose file</label>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <input class="btn btn-success" type="submit" value="Upload">
                        </div>
                  </form>
                  </div>
               
               </div>
               <small align="center"> Note : <span class="text text-danger">Necessary measures were taken in the upload parts. Don't be cunning!</span></small>
               <!-- end modal body -->
            </div>
         </div>
      </div>
      <script src="lib/js/jquery.min.js"></script>
      <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
      <script src="lib/js/bootstrap-notify.min.js"></script>
      <script src="lib/js/all.js"></script>
      <script src="lib/js/bootstrap.min.js"></script>
     
      <script src="lib/js/google.js"></script>
   </body>
</html>
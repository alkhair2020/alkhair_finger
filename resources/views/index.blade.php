<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Fingerprint WebAPI Test App</title>
   
    <link rel="stylesheet" href="{{ asset('finger-assets/css/bootstrap-min.css') }}">
    <link rel="stylesheet" href="{{ asset('finger-assets/app.css') }}" type="text/css" />
</head>
<body>
    <div id="Container">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <div class="navbar-brand" href="#" style="color: white;">Fingerprint WebAPI</div>
            </div>
            <ul class="nav navbar-nav">
              <li id="Reader" class="active">
                <a href="#" style="color: white;" onclick="toggle_visibility(['content-reader','content-capture']);setActive('Reader','Capture')">
                    Reader</a>
              </li>
            </ul>
            <ul class="nav navbar-nav">
              <li id="Capture" class="">
                <a href="#" style="color: white;" onclick="toggle_visibility(['content-capture','content-reader']);setActive('Capture','Reader')">
                    Capture</a>
              </li>
            </ul>                       
          </div>
        </nav>
       <div id="Scores">
           <h5>Scan Quality : <input type="text" id="qualityInputBox" size="20" style="background-color:#DCDCDC;text-align:center;"></h5> 

       </div>
        <div id="content-capture" style="display : none;">    
        <form class="form" action="{{url('scanfinger')}}" method="get" name="le_form"  enctype="multipart/form-data">
                @csrf
                
                <input type="text" name="finger" id="fingervalue">
                <input type="submit" class="btn btn-primary" value="حفظ" />
            </form>
            <div id="status"></div>            
            <div id="imagediv"></div>
            <div id="contentButtons">
                <table width=70% align="center">
                    <tr>
                        <td>
                            <input type="button" class="btn btn-primary" id="clearButton" value="Clear" onclick="Javascript:onClear()">
                        </td>
                        <td data-toggle="tooltip" title="Will work with the .png format.">
                            <input type="button" class="btn btn-primary" id="save" value="Save">
                        </td>
                        <td>
                            <input type="button" class="btn btn-primary" id="start" value="Start" onclick="Javascript:onStart()">
                        </td>
                        <td>
                           <input type="button" class="btn btn-primary" id="stop" value="Stop" onclick="Javascript:onStop()">
                        </td>
                        <td>
                            <input type="button" class="btn btn-primary" id="info" value="Info" onclick="Javascript:onGetInfo()">
                        </td>
                </table>
            </div>
            
            <div id="imageGallery">
            </div>
            <div id="deviceInfo">           
            </div>

            <div id="saveAndFormats">
              <form name="myForm" style ="border : solid grey;padding:5px;">
              <b>Acquire Formats :</b><br>
              <table>
                <tr data-toggle="tooltip" title="Will save data to a .raw file.">
                  <td>
                    <input type="checkbox" name="Raw" value="1" onclick="checkOnly(this)"> RAW  <br>
                  </td>
                </tr>
                <tr data-toggle="tooltip" title="Will save data to a Intermediate file">
                  <td>
              <input type="checkbox" name="Intermediate" value="2" onclick="checkOnly(this)"> Feature Set (Intermediate)<br>
                  </td>
                </tr>
                <tr data-toggle="tooltip" title="Will save data to a .wsq file.">
                  <td>
              <input type="checkbox" name="Compressed" value="3" onclick="checkOnly(this)"> WSQ (Compressed)<br>
                  </td>
                </tr>
                <tr data-toggle="tooltip" title="Will save data to a .png file.">
                  <td>
              <input type="checkbox" name="PngImage" checked="true" value="4" onclick="checkOnly(this)"> PNG
                  </td>
                </tr>
              </table>
              </form>
              <br>
             <input type="button" class="btn btn-primary" id="saveImagePng" value="Export" onclick="Javascript:onImageDownload()">
            </div>
            
            <div id="codFingerSuccess"></div>
        </div>

        <div id="content-reader">  
            <h4>Select Reader :</h4>
            <select class="form-control" id="readersDropDown" onchange="selectChangeEvent()">
            </select>
            <div id="readerDivButtons">
                <table width=70% align="center">
                        <tr>
                            <td>
                                <input type="button" class="btn btn-primary" id="refreshList" value="Refresh List" 
                                    onclick="Javascript:readersDropDownPopulate(false)">
                            </td>
                            <td>
                                <input type="button" class="btn btn-primary" id="capabilities" value="Capabilities"
                                data-toggle="modal" data-target="#myModal" onclick="Javascript:populatePopUpModal()">
                            </td>  
                        </tr>
                </table>

              <!-- Modal - Pop Up window content-->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content -->
                  <div class="modal-content" id="modalContent" >
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Reader Information</h4>
                    </div>
                    <div class="modal-body" id="ReaderInformationFromDropDown">
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  
                </div>
              </div>
  
            </div>
        </div>

</div>

    <script src="{{ asset('finger-assets/lib/jquery.min.js') }}"></script> 
    <script src="{{ asset('finger-assets/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('finger-assets/scripts/es6-shim.js') }}"></script>
    <script src="{{ asset('finger-assets/scripts/websdk.client.bundle.min.js') }}"></script>
    <script src="{{ asset('finger-assets/scripts/fingerprint.sdk.min.js') }}"></script>
    <script src="{{ asset('finger-assets/app.js') }}"></script>
        
</body>
</html>

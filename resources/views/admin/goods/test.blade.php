@extends('admin.layout.layout')
@section('content')
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/d/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/plugins/imgareaselect/css/imgareaselect-default.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/plugins/jgrowl/jquery.jgrowl.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/d/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/d/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/d/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/d/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/jui/css/jquery.ui.timepicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/d/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/d/css/themer.css" media="screen">

<title>asd</title>

</head>
<body>


<!-- <div class="mws-panel grid_4"> -->
                	<!-- <div class="mws-panel-header"> -->
                    	<!-- <span><i class="icon-warning-sign"></i> jQuery-UI Dialog</span> -->
                    <!-- </div> -->
                    <!-- <div class="mws-panel-body" style="text-align: center"> -->
                    	<!-- <div class="mws-panel-content"> -->
                        	<!-- <input type="button" id="mws-jui-dialog-btn" class="btn btn-danger" value="Show Dialog"> -->
                        	<!-- <input type="button" id="mws-jui-dialog-mdl-btn" class="btn btn-primary" value="Show Modal Dialog"> -->
                        	<!-- <input type="button" id="mws-form-dialog-mdl-btn" class="btn btn-success" value="Show Modal Form"> -->




                        <!-- </div> -->
                    <!-- </div>    	 -->
                <!-- </div> -->

				<input type="button" id="mws-form-dialog-mdl-btn" class="btn btn-success" value="Show Modal Form">
				<div class="mws-panel grid_4">
                	<div class="mws-panel-header">
                    	<span><i class="icon-warning-sign"></i> jQuery-UI Dialog</span>
                    </div>
                    <div class="mws-panel-body" style="text-align: center">
                    	<div class="mws-panel-content">
                        	<input type="button" id="mws-jui-dialog-btn" class="btn btn-danger" value="Show Dialog">
                        	<input type="button" id="mws-jui-dialog-mdl-btn" class="btn btn-primary" value="Show Modal Dialog">


                            <div id="mws-jui-dialog">
                        		<div class="mws-dialog-inner">
                            		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi tellus, faucibus tristique faucibus sit amet, lacinia at velit. Proin pretium vulputate orci, nec luctus odio volutpat ac. Curabitur semper adipiscing tellus sed venenatis. Integer vitae diam dui. Ut ut quam ac ante eleifend aliquam. Cras tincidunt pulvinar sollicitudin. Nullam mattis justo nec nisl adipiscing ullamcorper. Curabitur fermentum egestas massa, eu dictum ligula accumsan id. Duis elit arcu, adipiscing vel consectetur ac, fermentum ac nisl. Quisque varius ipsum vitae mauris cursus eu tristique velit dapibus. Cras eu viverra neque.</p>
                                </div>
                            </div>

                            <div id="mws-form-dialog">
                                <form id="mws-validate" class="mws-form" action="form_elements.html">
                                    <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                                    <div class="mws-form-inline">
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Required Validation</label>
                                            <div class="mws-form-item">
                                                <input type="text" name="reqField" class="required">
                                            </div>
                                        </div>
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Email Validation</label>
                                            <div class="mws-form-item">
                                                <input type="text" name="emailField" class="required email">
                                            </div>
                                        </div>
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">URL Validation</label>
                                            <div class="mws-form-item">
                                                <input type="text" name="urlField" class="required url">
                                            </div>
                                        </div>
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Date Validation</label>
                                            <div class="mws-form-item">
                                                <input type="text" class="mws-datepicker required date" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Select Box Validation</label>
                                            <div class="mws-form-item">
                                                <select class="required" name="selectBox">
                                                    <option></option>
                                                    <option>Option 1</option>
                                                    <option>Option 3</option>
                                                    <option>Option 4</option>
                                                    <option>Option 5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">File Input Validation</label>
                                            <div class="mws-form-item">
                                                <input type="file" name="picture" class="required">
                                                <label for="picture" class="error" generated="true" style="display:none"></label>
                                            </div>
                                        </div>
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Spinner Validation</label>
                                            <div class="mws-form-item">
                                                <input type="text" id="s1" name="spinner" class="required mws-spinner" value="10.5">
                                                <label for="s1" class="error" generated="true" style="display:none"></label>
                                            </div>
                                        </div>
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Radiobutton Validation</label>
                                            <div class="mws-form-item">
                                                <ul class="mws-form-list">
                                                    <li><input id="gender_male" type="radio" name="gender" class="required"> <label for="gender_male">Male</label></li>
                                                    <li><input id="gender_female" type="radio" name="gender"> <label for="gender_female">Female</label></li>
                                                </ul>
                                                <label for="gender" class="error plain" generated="true" style="display:none"></label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-pencil-2"></i> WYSIWYG Editor</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="form_elements.html">
            <div class="mws-form-row">
                <label class="mws-form-label">WYSIWYG</label>
                <div class="mws-form-item">
                    <div class="cleditorMain" style="width: 100%; height: 250px;"><div class="cleditorToolbar" style="height: 27px;"><div class="cleditorGroup"><div class="cleditorButton cleditorDisabled" title="Bold" disabled="disabled" style="background-color: transparent;"></div><div class="cleditorButton cleditorDisabled" title="Italic" disabled="disabled" style="background-position: -24px center; background-color: transparent;"></div><div class="cleditorButton cleditorDisabled" title="Underline" disabled="disabled" style="background-position: -48px center;"></div><div class="cleditorButton cleditorDisabled" title="Strikethrough" disabled="disabled" style="background-position: -72px center;"></div><div class="cleditorButton cleditorDisabled" title="Subscript" disabled="disabled" style="background-position: -96px center;"></div><div class="cleditorButton cleditorDisabled" title="Superscript" disabled="disabled" style="background-position: -120px center;"></div><div class="cleditorDivider"></div></div><div class="cleditorGroup"><div class="cleditorButton cleditorDisabled" title="Font" disabled="disabled" style="background-position: -144px center;"></div><div class="cleditorButton cleditorDisabled" title="Font Size" disabled="disabled" style="background-position: -168px center;"></div><div class="cleditorButton cleditorDisabled" title="Style" disabled="disabled" style="background-position: -192px center;"></div><div class="cleditorDivider"></div></div><div class="cleditorGroup"><div class="cleditorButton cleditorDisabled" title="Font Color" disabled="disabled" style="background-position: -216px center;"></div><div class="cleditorButton cleditorDisabled" title="Text Highlight Color" disabled="disabled" style="background-position: -240px center;"></div><div class="cleditorButton cleditorDisabled" title="Remove Formatting" disabled="disabled" style="background-position: -264px center;"></div><div class="cleditorDivider"></div></div><div class="cleditorGroup"><div class="cleditorButton cleditorDisabled" title="Bullets" disabled="disabled" style="background-position: -288px center;"></div><div class="cleditorButton cleditorDisabled" title="Numbering" disabled="disabled" style="background-position: -312px center;"></div><div class="cleditorDivider"></div></div><div class="cleditorGroup"><div class="cleditorButton cleditorDisabled" title="Outdent" disabled="disabled" style="background-position: -336px center;"></div><div class="cleditorButton cleditorDisabled" title="Indent" disabled="disabled" style="background-position: -360px center;"></div><div class="cleditorDivider"></div></div><div class="cleditorGroup"><div class="cleditorButton cleditorDisabled" title="Align Text Left" disabled="disabled" style="background-position: -384px center;"></div><div class="cleditorButton cleditorDisabled" title="Center" disabled="disabled" style="background-position: -408px center;"></div><div class="cleditorButton cleditorDisabled" title="Align Text Right" disabled="disabled" style="background-position: -432px center;"></div><div class="cleditorButton cleditorDisabled" title="Justify" disabled="disabled" style="background-position: -456px center;"></div><div class="cleditorDivider"></div></div><div class="cleditorGroup"><div class="cleditorButton cleditorDisabled" title="Undo" disabled="disabled" style="background-position: -480px center;"></div><div class="cleditorButton cleditorDisabled" title="Redo" disabled="disabled" style="background-position: -504px center;"></div><div class="cleditorDivider"></div></div><div class="cleditorGroup"><div class="cleditorButton cleditorDisabled" title="Insert Horizontal Rule" disabled="disabled" style="background-position: -528px center;"></div><div class="cleditorButton cleditorDisabled" title="Insert Table" disabled="disabled" style="background-image: url(&quot;plugins/cleditor/images/table.gif&quot;);"></div><div class="cleditorButton cleditorDisabled" title="Insert Image" disabled="disabled" style="background-position: -552px center;"></div><div class="cleditorButton cleditorDisabled" title="Insert Hyperlink" disabled="disabled" style="background-position: -576px center;"></div><div class="cleditorButton cleditorDisabled" title="Remove Hyperlink" disabled="disabled" style="background-position: -600px center;"></div><div class="cleditorButton cleditorDisabled" title="Insert Icon" disabled="disabled" style="background-image: url(&quot;plugins/cleditor/images/icons/icons.gif&quot;); background-position: 2px 2px;"></div><div class="cleditorDivider"></div></div><div class="cleditorGroup"><div class="cleditorButton cleditorDisabled" title="Cut" disabled="disabled" style="background-position: -624px center;"></div><div class="cleditorButton cleditorDisabled" title="Copy" disabled="disabled" style="background-position: -648px center;"></div><div class="cleditorButton cleditorDisabled" title="Paste" disabled="disabled" style="background-position: -672px center;"></div><div class="cleditorButton cleditorDisabled" title="Paste as Text" disabled="disabled" style="background-position: -696px center;"></div><div class="cleditorDivider"></div></div><div class="cleditorGroup"><div class="cleditorButton" title="Print" style="background-position: -720px center;"></div><div class="cleditorButton" title="Show Source" style="background-position: -744px center;"></div></div></div><textarea id="cleditor" class="large" style="display: none; width: 982px; height: 223px;"></textarea><iframe frameborder="0" src="javascript:true;" style="width: 982px; height: 223px;"></iframe></div>
                </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" value="Submit" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>

<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-ok"></i> Validation</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form id="mws-validate" class="mws-form" action="form_elements.html">
            <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">Required Validation</label>
                    <div class="mws-form-item">
                        <input type="text" name="reqField" class="required large">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Email Validation</label>
                    <div class="mws-form-item">
                        <input type="text" name="emailField" class="required email large">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">URL Validation</label>
                    <div class="mws-form-item">
                        <input type="text" name="urlField" class="required url large">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Digit Validation</label>
                    <div class="mws-form-item">
                        <input type="text" name="ageField" class="required digits large">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Select Box Validation</label>
                    <div class="mws-form-item">
                        <select class="required large" name="selectBox">
                            <option></option>
                            <option>Option 1</option>
                            <option>Option 3</option>
                            <option>Option 4</option>
                            <option>Option 5</option>
                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">File Input Validation</label>
                    <div class="mws-form-item">
                        <input type="file" name="picture" class="required">
                        <label for="picture" class="error" generated="true" style="display:none"></label>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Spinner Validation</label>
                    <div class="mws-form-item">
                        <input type="text" id="s4" name="spinner" class="required mws-spinner" value="10">
                        <label for="s4" class="error" generated="true" style="display:none"></label>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Radiobutton Validation</label>
                    <div class="mws-form-item">
                        <ul class="mws-form-list">
                            <li><input id="gender_male" type="radio" name="gender" class="required"> <label for="gender_male">Male</label></li>
                            <li><input id="gender_female" type="radio" name="gender"> <label for="gender_female">Female</label></li>
                        </ul>
                        <label for="gender" class="error plain" generated="true" style="display:none"></label>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>



<!-- JavaScript Plugins -->
    <script src="/d/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/d/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/d/js/libs/jquery.placeholder.min.js"></script>
    <script src="/d/custom-plugins/fileinput.js"></script>

    <!-- jQuery-UI Dependent Scripts -->
    <script src="/d/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/d/jui/jquery-ui.custom.min.js"></script>
    <script src="/d/jui/js/jquery.ui.touch-punch.js"></script>
    <script src="/d/jui/js/timepicker/jquery-ui-timepicker.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="/d/plugins/imgareaselect/jquery.imgareaselect.min.js"></script>
    <script src="/d/plugins/jgrowl/jquery.jgrowl-min.js"></script>
    <script src="/d/plugins/validate/jquery.validate-min.js"></script>
    <script src="/d/plugins/colorpicker/colorpicker-min.js"></script>

    <!-- Core Script -->
    <script src="/d/bootstrap/js/bootstrap.min.js"></script>
    <script src="/d/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/d/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/d/js/demo/demo.widget.js"></script>

</body>
</html>
@endsection

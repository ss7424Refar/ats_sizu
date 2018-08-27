<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="resource/img/3.ico"/>
    <title>Automation Test System | Starter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
    <style>
        /*.select2-results__option[aria-selected=true]{*/
        /*display:none;*/
        /*}*/

    </style>
    <!--PACE-->
    <link rel="stylesheet" href="../plugins/pace/pace.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/iCheck/all.css">
    <!--    bootstrapValidator-->
    <link href="../plugins/bootstrapvalidator/dist/css/bootstrapValidator.min.css" rel="stylesheet">

    <!--    toastr-->
    <link href="../plugins/CodeSeven-toastr/build/toastr.min.css" rel="stylesheet" />

    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="../dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="../dist/js/html5shiv.min.js"></script>
    <script src="../dist/js/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="../dist/css/googleFont.css">

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<!--<body class="hold-transition skin-blue layout-boxed">-->
<div class="wrapper">
    <!-- Main Header -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add Task
                <small>For Jump Start</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="../../ats_kimi/application/index/pass/atsIndex.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li>Add Task</li>
                <li class="active">Jump Start</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container">
            <div class="row">
                <div class="col-md-8 col-md-offset-1">
                    <div class="box box-primary">
                        <form role="form"  class="form-horizontal" id="addTaskForm" action="target.php" method="post">
                            <div class="box-body">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Test Image</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="testImage"></select>
                                    </div>
                                </div>

                            <div class="box-footer">
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Select2 -->
<script src="../bower_components/select2/dist/select2.min.js"></script>

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
    $(function () {

        // ----------------------- dataInit -----------------------
        testImage = $("select[name='testImage']");

        select2Init();

    });


    function  select2Init() {
        testImage.select2({
                width: "100%",
                ajax: {
                    url: "../functions/atsController.php?do=getImageName4Select2",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: false
                },
                placeholder: 'Please Select',
                allowClear: true
            }
        );

        testMachine.select2({
            width: "100%",
            ajax: {
                // url: 'function/readAddData.php',
                url: "../functions/atsController.php?do=readMachine4Select2",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: false
            },
            placeholder:'Please Select',
            allowClear:true
        });


        testMachine.on("select2:clear", function (e) {
            if (addDefaultCK.prop('checked')){
                pDmiInfo.css('display', 'none').find('p').html('');
            } else {
                inputDmiInfo.find('p').html('N/A');
            }
        });

    };



    function addFormValidatorInit(){
        $('#addTaskForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                testImage: {
                    message: 'the testImage is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The testImage is required and can\'t be empty'
                        }
                    }
                }
            }

        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            var addMachine = testMachine.select2('data')[0].text;
            var testItem = "JumpStart";
            var addImage = testImage.select2('data')[0].text;
            console.log(addImage + ',' + addMachine);
            var testMachineVal = testMachine.val();
            var machineId = addMachine;
            if (null != machineId) {
                machineId = machineId.replace(testMachineVal, '');
                machineId = machineId.substring(1, machineId.length - 1);
            }

            if (addDefaultCK.prop('checked')){
                // Use Ajax to submit form data
                $.ajax({
                    type : "get",
                    url: "../functions/atsController.php?do=addTask",
                    data: {
                        testMachine: addMachine,
                        machineId: machineId,
                        testItem: testItem,
                        testImage: addImage,
                        customer: 'default',
                        addProduct: pDmiInfo.find('p:eq(0)').text(),
                        addSN: pDmiInfo.find('p:eq(1)').text(),
                        addPN: pDmiInfo.find('p:eq(2)').text(),
                        addOem:pDmiInfo.find('p:eq(3)').text(),
                        addSystem: pDmiInfo.find('p:eq(4)').text(),
                        lanIp: pDmiInfo.find('p:eq(5)').text(),
                        shelf: pDmiInfo.find('p:eq(6)').text()
                    },
                    success : function (result) {
                        console.log(result);
                        if (result == "success") {
                            toastr.success('add success!');

                        } else {
                            toastr.error('add fail! try again ');
                        }
                    },
                    error : function(xhr,status,error){
                        toastr.error(xhr.status + ' add fail! ');
                    },
                    complete : function () {
                        setTimeout("window.location.href=\"taskManagerForJump.php\";",3000);

                    }
                });

            } else {
                // Use Ajax to submit form data
                $.ajax({
                    type : "get",
                    url: "../functions/atsController.php?do=addTask",
                    data: {
                        testMachine: addMachine,
                        machineId: machineId,
                        testItem: testItem,
                        testImage: addImage,
                        customer: 'customer',
                        addProduct: inputDmiInfo.find('input:eq(0)').val(),
                        addSN: inputDmiInfo.find('input:eq(1)').val(),
                        addPN: inputDmiInfo.find('input:eq(2)').val(),
                        addOem: inputDmiInfo.find('input:eq(3)').val(),
                        addSystem: inputDmiInfo.find('input:eq(4)').val(),
                        lanIp: inputDmiInfo.find('p:eq(0)').text(),
                        shelf: inputDmiInfo.find('p:eq(1)').text(),
                    },
                    success : function (result) {
                        console.log(result);
                        if (result == "success") {
                            toastr.success('add success!');

                        } else {
                            toastr.error('add fail! try again ');
                        }
                    },
                    error : function(xhr,status,error){
                        toastr.error(xhr.status + ' add fail! ');
                    },
                    complete : function () {
                        setTimeout("window.location.href=\"taskManagerForJump.php\";",3000);

                    }
                });

            }
        });

    };
</script>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: refar
 * Date: 18-8-27
 * Time: 下午3:24
 */
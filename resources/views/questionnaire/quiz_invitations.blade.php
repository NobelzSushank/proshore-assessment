<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>

        <meta charset="utf-8" />
        <meta name="csrf-token" content={{ csrf_token() }}>
        <title>Haze Project</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

        <!-- alertifyjs Css -->
        <link href="{{asset('backend/assets/libs/alertifyjs/build/css/alertify.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- alertifyjs default themes  Css -->
        <link href="{{asset('backend/assets/libs/alertifyjs/build/css/themes/default.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- plugin css -->
        <link href="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

        <!-- preloader css -->
        <link rel="stylesheet" href="{{ asset('backend/assets/css/preloader.min.css') }}" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        
        <!-- Icons Css -->
        <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        

        <!-- Sweetalert2 -->
        <link href="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="{{asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- Flatpickr -->
        <link href="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">

        <!-- App Css-->
        <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        @stack('styles')

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="">

                <div class="page-content">
                    <div class="container-fluid">
                        <x-error />
                        <x-success />

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h4 class="card-title">{{$pageTitle}} : {{ $questionnaire->title }}</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('questionnaire.invitation.submit', $questionnaire->id) }}" method="post">
                                            @csrf
                                            @foreach ($questionnaire->questions as $question)
                                                <h3>{{ $question->question }}</h3>
                                                
                                                    <label>
                                                        <input type="radio" name="answers[{{ $question->id }}]" value="a">
                                                        {{ $question->option_a }}
                                                    </label><br>
                    
                                                    <label>
                                                        <input type="radio" name="answers[{{ $question->id }}]" value="b">
                                                        {{ $question->option_b }}
                                                    </label><br>
                    
                                                    <label>
                                                        <input type="radio" name="answers[{{ $question->id }}]" value="c">
                                                        {{ $question->option_c }}
                                                    </label><br>
                    
                                                    <label>
                                                        <input type="radio" name="answers[{{ $question->id }}]" value="d">
                                                        {{ $question->option_d }}
                                                    </label><br>
                                                
                                                <hr>
                                            @endforeach
                                            <button type="submit">Submit Quiz</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        
        <!-- Right Sidebar -->
        <x-cms-right-sidebar />
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        @stack('modal')

        <!-- JAVASCRIPT -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js')}}"></script>
        <!-- pace js -->
        <script src="{{ asset('backend/assets/libs/pace-js/pace.min.js')}}"></script>

        <!-- Required datatable js -->
        <script src="{{asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Buttons examples -->
        <script src="{{asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
        <script src="{{asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

        <!-- apexcharts -->
        <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- datepicker js -->
        <script src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

        <!-- Plugins js-->
        <script src="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>

        <!-- alertifyjs js -->
        <script src="{{asset('backend/assets/libs/alertifyjs/build/alertify.min.js')}}"></script>

        <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

        <script src="{{ asset('backend/assets/js/app.js')}}"></script>

        @include('utilities.messages')

        @stack('scripts')

    </body>

</html>

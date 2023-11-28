@extends('admin.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css">
    <link rel="stylesheet" type="text/css"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.8/css/bootstrap-switch.css">
    <link rel="stylesheet" type="text/css"
          href="https://davidstutz.github.io/bootstrap-multiselect/css/bootstrap-multiselect.css">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript"
            src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.8/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript"
            src="https://davidstutz.github.io/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
    <style>
        .indent-small {
            margin-left: 5px;
        }

        .form-group.internal {
            margin-bottom: 0;
        }

        .dialog-panel {
            margin: 10px;
        }

        .datepicker-dropdown {
            z-index: 200 !important;
        }

        .panel-body {

            background: #e5e5e5; /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%); /* FF3.6+ */
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff)); /* Chrome,Safari4+ */
            background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%); /* Chrome10+,Safari5.1+ */
            background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%); /* Opera 12+ */
            background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%); /* IE10+ */
            background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1); /* IE6-9 fallback on horizontal gradient */

            font: 600 15px "Open Sans", Arial, sans-serif;
        }

        label.control-label {
            font-weight: 600;
            color: #777;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <div class="panel panel-primary dialog-panel">
            <div class="panel-heading">
                <h5>Create Your System</h5>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="id_title" class="control-label col-md-2 col-md-offset-2">Name</label>
                        <div class="col-md-8">
                            <div class="col-md-8 indent-small">
                                <div class="form-group internal">
                                    <input class="form-control" type="text" id="id_first_name"
                                           placeholder="Meal System Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_email" class="control-label col-md-2 col-md-offset-2">Number of Members</label>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-11">
                                    <input class="form-control" type="number" id="id_email"
                                           placeholder="Number of members">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Hidden member card template -->
                    <div id="memberTemplate" style="display: none;">
                        <div class="card member-card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="informations" class="control-label col-md-2 col-md-offset-2">Members Informations</label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-11">
                                            <input type="text" class="form-control" style="margin-bottom: 5px" placeholder="Member Name">
                                            <input type="tel" class="form-control" style="margin-bottom: 5px" placeholder="Phone">
                                            <input type="email" class="form-control" style="margin-bottom: 5px" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container for dynamically added member cards -->
                    <div id="memberCardsContainer"></div>
                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-3">
                            <button type="submit" class="btn-lg btn-primary">Request Reservation</button>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn-lg btn-danger" style="float:right">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.multiselect').multiselect();
            $('.datepicker').datepicker();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#id_email').on('change', function () {
                var numberOfMembers = $(this).val();
                adjustMemberCards(numberOfMembers);
            });

            function adjustMemberCards(number) {
                var container = $('#memberCardsContainer');
                var currentCards = container.find('.member-card').length;
                var template = $('#memberTemplate .member-card');

                if (number > currentCards) {
                    for (var i = currentCards; i < number; i++) {
                        container.append(template.clone());
                    }
                } else {
                    for (var i = number; i < currentCards; i++) {
                        container.find('.member-card').last().remove();
                    }
                }
            }
        });
    </script>
@endpush

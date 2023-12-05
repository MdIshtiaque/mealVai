@extends('admin.master')

@section('content')
    <div class="row small-spacing">
        <div class="col-xs-12">
            <div class="invoice-box">
                <table>
                    <tr class="top">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td class="title">
                                        <a href="#" class="logo">Add<span>Friend</span></a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="information">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td>
                                        <h2 style="margin-bottom: -33px !important;">Your Friend Code: </h2><br>
                                        <h3>000 000 000</h3><br>
                                    </td>

                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="heading">
                        <td>
                            Search friends by name or email
                        </td>
                        <td>

                        </td>
                    </tr>

                    <tr class="details">
                        <td style="width: 100% !important;">
                            <div class="form-group">
                                <input type="text" name="search" id="search" placeholder="Search by name or email"
                                       class="form-control form-control-lg">
                                <!-- Larger form control for better visibility -->
                            </div>
                        </td>

                        <td>

                        </td>
                    </tr>
                </table>
                <table id="search-results">

                </table>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/custom-js/search-users.js') }}"></script>
    <script src="{{ asset('assets/custom-js/send-friend-request.js') }}"></script>
    <script src="{{ asset('assets/custom-js/cancel-friend-request.js') }}"></script>
@endpush

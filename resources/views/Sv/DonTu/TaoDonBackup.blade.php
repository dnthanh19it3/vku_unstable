@extends('layout.sv_layout')
@section('body')
    <div class="card">
        <div class="card-header border-bottom">
            <!-- Wizard navigation-->
            <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                <!-- Wizard navigation item 1-->
                <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-toggle="tab" role="tab"
                    aria-controls="wizard1" aria-selected="true">
                    <div class="wizard-step-icon"><h6>Bước 1</h6></div>
                    <div class="wizard-step-text">
                        <div class="wizard-step-text-name"><h6>Chọn mẫu</h6></div>
                        <div class="wizard-step-text-details">Chọn mẫu đơn cần nộp</div>
                    </div>
                </a>
                <!-- Wizard navigation item 2-->
                <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-toggle="tab" role="tab"
                    aria-controls="wizard2" aria-selected="false">
                    <div class="wizard-step-icon"><h6>Bước 2</h6></div>
                    <div class="wizard-step-text">
                        <div class="wizard-step-text-name"><h6>Nhập thông tin</h6></div>
                        <div class="wizard-step-text-details">Nhập đầy đủ thông tin cần thiết</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content" id="cardTabContent">
                <!-- Wizard tab pane item 1-->
                <div class="tab-pane py-5 py-xl-10 fade active show" id="wizard1" role="tabpanel"
                    aria-labelledby="wizard1-tab">
                    <div class="row justify-content-center">
                        <div class="col-xxl-10 col-xl-10">
                            <h3 class="text-primary">Bước 1</h3>
                            <h5 class="card-title">Chọn mẫu đơn cần nộp</h5>
                            <div id="table_content">
                                <!--Table-->
                                <div class="datatable">
                                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-bordered table-hover dataTable" id="dataTable"
                                                    width="100%" cellspacing="0" role="grid"
                                                    aria-describedby="dataTable_info" style="width: 100%;">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending"
                                                                style="width:30px;">STTT
                                                            </th>
                                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending"
                                                                style="">Tên đơn
                                                            </th>
                                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending"
                                                                style="width:120px;">Thời gian xử lý
                                                            </th>
                                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable"
                                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                                aria-label="Name: activate to sort column descending"
                                                                style="width:120px">Hành động
                                                            </th>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th rowspan="1" colspan="1">STT</th>
                                                            <th rowspan="1" colspan="1">Tên hồ sơ</th>
                                                            <th rowspan="1" colspan="1">Thời gian xử lý</th>
                                                            <th rowspan="1" colspan="1">Hành động</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        @foreach ($danhsachdon as $item)
                                                            <tr role="row" class="odd">
                                                                <td class="sorting_1">{{ $i += 1 }}</td>
                                                                <td>{{ $item->tenmaudon }}</td>
                                                                <td>{{ $item->thoigianxuly }}</td>
                                                                <td>
                                                                    <button class="btn btn-sm btn-primary"
                                                                        type="button"
                                                                        onclick="loadform({{ $item->maudon_id }})">Nộp
                                                                        đơn</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        <script>
                                                            function loadform(maudon_id) {
                                                                $.ajax({
                                                                    url: "{{ route('ajaxTruongDon') }}?maudon_id=" +
                                                                        maudon_id,
                                                                    success: function(result) {
                                                                        $("#form_space").html(result);
                                                                    }
                                                                });
                                                                $('#wizard2-tab').click()
                                                            }

                                                        </script>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-7">
                                                <div class="dataTables_paginate paging_simple_numbers"
                                                    id="dataTable_paginate">
                                                    {{$danhsachdon->links()}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End table-->
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Wizard tab pane item 2-->
                <div class="tab-pane py-5 py-xl-10 fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                    <div class="row justify-content-center">
                        <div class="col-xxl-10 col-xl-10">
                            <h3 class="text-primary">Bước 2</h3>
                            {{-- <h5 class="card-title">Nhập thông tin</h5> --}}
                            <div id="form_space">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

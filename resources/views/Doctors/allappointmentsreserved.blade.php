@extends('Backend.master')

@section('content')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <br><br><br><br>
    <br>
    <div class="text-center font-bold">
        <h1>جميع المواعيد المحجوزة</h1>
    </div>
    <div class="row container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> <!-- Button trigger modal -->

                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table table-striped table-hover" style="direction: rtl;">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center">إسم الطالب</th>
                                    <th> البريد الإلكتروني</th>
                                    <th class="text-center">العنوان</th>
                                    <th class="text-center">تاريخ الحجز</th>
                                    <th class="text-center">التفاصيل</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N</th>
                                    <th class="text-center">إسم الطالب</th>
                                    <th> البريد الإلكتروني</th>
                                    <th class="text-center">العنوان</th>
                                    <th class="text-center">تاريخ إنشاء الحجز</th>
                                    <th class="text-center">التفاصيل</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allappointmentsreserved as $reserved)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $reserved->name }}</td>
                                        <td>{{ $reserved->email }}</td>
                                        <td>{{ $reserved->address }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reserved->updated_at)->format('y - m - d') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info" data-toggle="modal"
                                                data-target="#exampleModalReservation{{ $reserved->id }}">التفاصيل</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->

        @foreach ($allappointmentsreserved as $reserved)
            <div class="modal fade container-fluid" id="exampleModalReservation{{ $reserved->id }}" tabindex="-1"
                role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info-gradient">
                            <h5 class="modal-title m-auto" style="font-size: 30px;" id="exampleModalLongTitle">تفاصيل الحجز
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="bg-danger text-dark"> &times;</span>
                            </button>
                        </div>
                        <div class="row">

                            <div class="modal-body m-auto w-50" style="direction: rtl;">

                                <br><br>
                                <div class="col-lg-12 col-md-10 col-sm-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>التاريخ المحجوز : </strong></td>
                                                        <td class="text-center"><strong><span
                                                                    class="text-primary">{{ $reserved->doctor_date }}
                                                                </span></strong></td>
                                                        <td><strong> </strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>وصف حالة المريض :</strong> </td>
                                                        <td class="text-center"><strong>
                                                                <p>{{ $reserved->description }}</p>
                                                            </strong> </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>إسم المستخدم :</strong> </td>
                                                        <td class="text-center"><strong>{{ $reserved->user_name }}</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>رقم هاتف المريض :</strong> </td>
                                                        <td class="text-center"><strong>{{ $reserved->phone }}</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>حالة الحجز :</strong> </td>
                                                        <td class="text-center"><strong>
                                                                @if ($reserved->status == '1')
                                                                    <span class="badge badge-success">مؤكد</span>
                                                                @else
                                                                    <span class="badge badge-danger">غير مؤكد</span>
                                                                @endif
                                                            </strong> </td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        @if ($reserved->status == '1')
                                                            <td class="text-center"> <a
                                                                    href="{{ route('cancel.reservationsappointment', $reserved->id) }}"><button
                                                                        class="btn btn-block btn-danger" id="delete">حذف
                                                                        الحجز
                                                                    </button></a></td>
                                                        @else
                                                            <td class="text-center"><a
                                                                    href="{{ route('confirm.reservationsappointment', $reserved->id) }}"><button
                                                                        class="btn btn-block btn-success"
                                                                        id="confirm">تأكيد
                                                                        الحجز</button></a></td>
                                                        @endif

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection

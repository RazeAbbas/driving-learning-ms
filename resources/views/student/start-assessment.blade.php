@extends('layouts.student-assessment')
@section('content')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin-top: 50px;
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #235347;
            color: #fff;
            border-radius: 15px 15px 0 0;
            padding: 20px;
        }

        .card-body {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #235347;
            color: #fff;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ @$courses->course_name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title fw-bold">Assessment Details</h5>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Total Qustions</th>
                                <th scope="col">Total Duration</th>
                                <th scope="col">Passing Percentage</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td><b>Total Qustions</b></td>
                                <td><b>Total Duration</b></td>
                                <td><b>Passing Percentage</b></td>
                            </tr>
                            <tr>
                                <td>{{ $assessment->questions->count() }}</td>
                                <td>{{ $assessment->time_duration }}</td>
                                <td>{{ $assessment->passing_percentage }}%</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-5">
                        <a href="{{ url('student/assessment', $assessment->id) }}" class="rts-btn btn-primary">Start Now</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

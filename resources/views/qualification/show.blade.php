@extends('layouts.app')

@section('template_title')
    {{ $qualification->name ?? 'Show Qualification' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Qualification</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('qualifications.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Teacher Users Id:</strong>
                            {{ $qualification->teacher_users_id }}
                        </div>
                        <div class="form-group">
                            <strong>Student Users Id:</strong>
                            {{ $qualification->student_users_id }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $qualification->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

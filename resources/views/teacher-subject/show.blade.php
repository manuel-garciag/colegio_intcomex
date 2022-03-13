@extends('layouts.app')

@section('template_title')
    {{ $teacherSubject->name ?? 'Show Teacher Subject' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Teacher Subject</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('teacher-subjects.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Users Id:</strong>
                            {{ $teacherSubject->users_id }}
                        </div>
                        <div class="form-group">
                            <strong>Subjects Id:</strong>
                            {{ $teacherSubject->subjects_id }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $teacherSubject->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

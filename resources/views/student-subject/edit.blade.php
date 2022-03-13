@extends('layouts.app')

@section('template_title')
    Update Student Subject
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Student Subject</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('student-subjects.update', $studentSubject->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('student-subject.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

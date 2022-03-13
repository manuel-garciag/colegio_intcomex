@extends('layouts.app')

@section('template_title')
    {{ $setting->name ?? 'Show Setting' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Setting</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('settings.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nota Minima:</strong>
                            {{ $setting->nota_minima }}
                        </div>
                        <div class="form-group">
                            <strong>Num Notas:</strong>
                            {{ $setting->num_notas }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $setting->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

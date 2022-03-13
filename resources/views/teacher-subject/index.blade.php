@extends('layouts.app')

@section('template_title')
    Teacher Subject
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Teacher Subject') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('teacher-subjects.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Users Id</th>
										<th>Subjects Id</th>
										<th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teacherSubjects as $teacherSubject)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $teacherSubject->users_id }}</td>
											<td>{{ $teacherSubject->subjects_id }}</td>
											<td>{{ $teacherSubject->status }}</td>

                                            <td>
                                                <form action="{{ route('teacher-subjects.destroy',$teacherSubject->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('teacher-subjects.show',$teacherSubject->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('teacher-subjects.edit',$teacherSubject->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $teacherSubjects->links() !!}
            </div>
        </div>
    </div>
@endsection

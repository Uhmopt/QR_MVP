@extends('layouts.app', ['title' => __('Branch Management')])

@section('admin_title')
{{__('Branch Management')}}
@endsection

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center margin-5">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Branches') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            @if(auth()->user()->restorant->branchnum > auth()->user()->restorant->branches->count())
                                <a href="{{ route('branch.create') }}" class="btn btn-sm btn-primary">{{ __('Add Branch') }}</a>
                            @else
                                <a href="{{ route('branch.create') }}" class="btn btn-sm btn-primary disabled">{{ __('Add Branch') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        @include('partials.flash')
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Description') }}</th>
                                    <th scope="col">{{ __('Manger') }}</th>
                                    <th scope="col">{{ __('Manager email') }}</th>
                                    <th scope="col">{{ __('Creation Date') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                <tr>
                                    <td><a href="{{ route('branch.edit', $branch) }}">{{ $branch->name }}</a></td>
                                    <td>{{  $branch->description }}</td>
                                    <td>{{  $branch->user?$branch->user->name:__('Deleted') }}</td>
                                    <td>
                                        <a href="mailto: {{ $branch->user?$branch->user->email:""  }}">{{  $branch->user?$branch->user->email:__('Deleted')  }}</a>
                                    </td>
                                    <td>{{ $branch->created_at->format(env('DATETIME_DISPLAY_FORMAT','d M Y H:i')) }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> 
                                                <form action="{{ route('branch.destroy', $branch) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a class="dropdown-item" href="{{ route('branch.edit', $branch) }}">{{ __('Edit') }}</a>
                                                    <a class="dropdown-item" href="{{ route('qr.show', $branch) }}">{{ __('QR Builder') }}</a>
                                                    <button class="dropdown-item" >{{ __('Delete') }}</button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $branches->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection
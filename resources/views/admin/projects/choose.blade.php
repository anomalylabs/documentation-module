<div class="modal-header">
    <button class="close" data-dismiss="modal">
        <span>&times;</span>
    </button>
    <h4 class="modal-title">{{ trans('module::message.choose_project') }}</h4>
</div>

<div class="modal-body">

    @include('streams::modals/filter')

    <ul class="nav nav-pills nav-stacked">
        @foreach ($extensions as $extension)
            <li>
                <a href="{{ url('admin/documentation/create?documentation=' . $extension->namespace) }}">
                    <strong>{{ trans($extension->title) }}</strong>
                    <br>
                    <small>{{ trans($extension->description) }}</small>
                </a>
            </li>
        @endforeach
    </ul>
</div>

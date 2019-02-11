@extends('admin.layout')

@section('main')
    <div class="el-card">
        <div class="el-card__header title"><h2>Log Viewer</h2></div>
        <div class="el-card__body row">
            <div class="col-sm-2 sidebar mb-3">


                <div class="list-group">
                    @foreach($files as $file)
                        <a href="?l={{ \Illuminate\Support\Facades\Crypt::encrypt($file) }}"
                           class="list-group-item @if ($current_file == $file) llv-active @endif">
                            {{$file}}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-10 table-container">
                @if ($logs === null)
                    <div>
                        Log file >50M, please download it.
                    </div>
                @else
                    <table id="table-log" class="table table-striped" data-ordering-index="{{ $standardFormat ? 2 : 0 }}">
                        <thead>
                        <tr>
                            @if ($standardFormat)
                                <th>Level</th>
                                <th>Context</th>
                                <th>Date</th>
                            @else
                                <th>Line number</th>
                            @endif
                            <th>Content</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($logs as $key => $log)
                            <tr data-display="stack{{{$key}}}">
                                @if ($standardFormat)
                                    <td class="text-{{{$log['level_class']}}}"><span class="fa fa-{{{$log['level_img']}}}"
                                                                                     aria-hidden="true"></span>  {{$log['level']}}</td>
                                    <td class="text">{{$log['context']}}</td>
                                @endif
                                <td class="date">{{{$log['date']}}}</td>
                                <td class="text">
                                    @if ($log['stack']) <button type="button" class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                                                                data-display="stack{{{$key}}}"><span
                                                class="fa fa-search"></span></button>@endif
                                    {{{$log['text']}}}
                                    @if (isset($log['in_file'])) <br/>{{{$log['in_file']}}}@endif
                                    @if ($log['stack'])
                                        <div class="stack" id="stack{{{$key}}}"
                                             style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                                        </div>@endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @endif
                <div class="p-3">
                    @if($current_file)
                        <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}"><span class="fa fa-download"></span>
                            Download file</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
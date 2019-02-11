<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-02-08 00:36
 */
?>

@extends('admin.layout')

@section('main')

    <div class="container">
        <div class="el-card">
            <div class="el-card__header">
                <div class="title h2">{{ __('Problem List') }}</div>
            </div>

            <div class="el-card__body">

                <form method="GET" class="form-inline">

                    <div class="form-group mb-2 ">
                        <label for="categorySelect" class="sr-only">category</label>
                        <select id="categorySelect" class="form-control" name="category">
                            <option value="" {{ Request::get('category', null) == null ? 'selected': '' }}> Category... </option>
                            @foreach($categoryGroup as $category)
                                <option value="{{ $category->id }}" {{ Request::get('category', null) == $category->id ? 'selected': '' }}> {{ $category->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2 mx-sm-3">
                        <label for="ojSelect" class="sr-only">oj</label>
                        <select id="ojSelect" class="form-control" name="oj">
                            <option value="" {{ Request::get('oj', null) == null ? 'selected': '' }}> Origin OJ... </option>
                            @foreach($ojList as $oj)
                                <option value="{{ $oj }}" {{ Request::get('oj', null) == $oj ? 'selected': '' }}> {{ $oj }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2 mx-sm-3">
                        <input type="submit"class="form-control btn btn-primary" id="SubmitButton" value="Search">
                    </div>
                </form>

                <el-table :data="problemList" style="width: 100%" stripe>
                    <el-table-column type="index" width="150"></el-table-column>
                    <el-table-column prop="origin_oj" label="Origin OJ" width="180"> </el-table-column>
                    <el-table-column prop="origin_problem_id" label="Problem ID" width="150"> </el-table-column>

                    <el-table-column label="category" width="180">
                        <template slot-scope="scope">
                            <div class="form-group">
                                <div class="">
                                    <select :id="'categorySwitch-' + scope.row.id" class="form-control" name="category" @change="handleEdit(scope.row.id)">
                                         @foreach($categoryGroup as $category)
                                             <option value="{{ $category->id }}"
                                                     :selected=" scope.row.category_id == {{ $category->id }} ? 'selected' : '' "> {{$category->name}}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column prop="created_at" label="create time" width="150"> </el-table-column>
                    <el-table-column label="options" width="180">
                        <template slot-scope="scope">
                            <el-table-column  label="options" width="180">
                                <template slot-scope="scope">
                                    <el-button
                                            size="mini"
                                            type="danger"
                                            @click="handleDelete(scope.$index, scope.row.id)">{{ __('Delete') }}</el-button>
                                </template>
                            </el-table-column>
                        </template>
                    </el-table-column>
                </el-table>

                <div style="margin-top: 20px">
                    <el-button @click="addDialog = true">Add One</el-button>
                </div>

                <div class="link justify-content-center">
                    {{ $problems->appends(Request::query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="dialog-group">
        <el-dialog title="Add a student" :visible.sync="addDialog" width="40%" :show-close="false">

            <form id="addProblemForm" onsubmit="vue.handleAddSave(); return false;">

                <div class="form-group mb-2">
                    <label for="newProblemCategorySelect" class="col-form-label">Category</label>
                    <select id="newProblemCategorySelect" class="form-control" name="category_id">
                        @foreach($categoryGroup as $category)
                            <option value="{{ $category->id }}" > {{ $category->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label for="newProblemOjSelect" class="col-form-label">Origin OJ</label>
                    <select id="newProblemOjSelect" class="form-control" name="origin_oj">
                        @foreach($ojList as $oj)
                            <option value="{{ $oj }}"> {{ $oj }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label for="newProblemOriginProblemId" class="col-form-label">Origin ID</label>
                    <input type="text" class="form-control" id="newProblemOriginProblemId" name="origin_problem_id" placeholder="Origin ID" >
                </div>


                <div slot="footer" class="dialog-footer" style="margin-top: 25px">
                    <input type="reset" id="addFormReset" style="display: none">
                    <button type="button" @click="handleAddCancel()" class="el-button" >取 消</button>
                    <button type="button" @click="handleAddSave();" class="el-button el-button--primary"> 确 定 </button>
                </div>
            </form>

        </el-dialog>
    </div>

@endsection

@section('script')
    <script>
        const data = {
            data: function () {
                return {
                    addDialog: false,
                    problemList: JSON.parse( '@json($problems)' ).data,
                    categoryList: JSON.parse('@json($categoryGroup)'),
                }
            },

            methods: {
                handleDelete(index, id) {
                    this.$confirm('It will delete the Problem, are you sure?', 'Notice', {
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                    }).then(()=> {
                        axios.post( '{{ route('admin.problem.index') }}' + '/' + id, {
                            _method: 'Delete',
                        }).then( (response) => {
                            this.$message({
                                message: 'Delete success',
                                type: 'success',
                            });
                            this.problemList.splice(index, 1);
                        }).catch((error) => {
                            this.$message({
                                message: 'Delete fail',
                                type: 'error',
                            });
                            console.log(error)
                        });
                    }).catch((error) => {
                        this.$message({
                            type: 'info',
                            message: 'Cancel'
                        });
                        console.log(error)
                    })
                },

                handleAddSave() {
                    const addData = $('#addProblemForm').serializeArray();
                    $('#addFormReset').click();
                    this.addDialog = false;

                    let params = {};
                    for(x in addData) {
                        params[addData[x].name] = addData[x].value;
                    }

                    axios.post( '{{ route('admin.problem.index') }}' , params)
                        .then((response) => {
                            this.$message({
                                message: 'Add success',
                                type: 'success',
                            });
                            this.problemList.push({
                                id: response.data.id,
                                category_id: params.category_id,
                                origin_oj: params.origin_oj,
                                origin_problem_id: params.origin_problem_id,
                                created_at: response.data.date,
                            });
                        })
                        .catch((error) => {
                            this.$message({
                                message: 'Add fail',
                                type: 'error',
                            });
                            console.log(error)
                        });
                },

                handleAddCancel() {
                    $('#addFormReset').click();
                    this.addDialog = false;
                },

                handleEdit(id) {

                    axios.post( '{{ route('admin.problem.index') }}' + '/' + id,{
                        _method: 'PUT',
                        'category_id': $('#categorySwitch-' + id).val(),
                        }
                    ).then( (response) => {
                        this.$message({
                            message: 'Update success',
                            type: 'success',
                        });
                    }).catch((error) => {
                        this.$message({
                            message: 'Update fail',
                            type: 'error',
                        });
                        console.log(error)
                    });
                }
            }
        }
    </script>
@endsection



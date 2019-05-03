<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-02-03 19:40
 */
?>

@extends('admin.layout')

@section('main')

    <div class="container">
        <div class="el-card">
            <div class="el-card__header">
                <div class="title h2">{{ __('Student List') }}</div>
            </div>

            <div class="el-card__body">

                <form method="GET" class="form-inline">
                    <div class="form-group mb-2">
                        <label for="studentName" class="sr-only">Name</label>
                        <input type="text"class="form-control" id="studentName" name="name" placeholder="student name" value="{{ Request::get('name') }}">
                    </div>

                    <div class="form-group mb-2 mx-sm-3">
                        <label for="className" class="sr-only">Class</label>
                        <input type="text"class="form-control" id="className" name="class" placeholder="student class" value="{{ Request::get('class') }}">
                    </div>

                    <div class="form-group mb-2 ">
                        <label for="isUpdate" class="sr-only">Class</label>
                        <select id="isUpdate" class="form-control" name="isUpdate">
                            <option value="-1" {{ Request::get('isUpdate', -1) == -1 ? 'selected': '' }}> is update... </option>
                            <option value="0" {{ Request::get('isUpdate', -1) == 0 ? 'selected': '' }}> True </option>
                            <option value="1" {{ Request::get('isUpdate', -1) == 1? 'selected': '' }}> False </option>
                        </select>
                    </div>

                    <div class="form-group mb-2 mx-sm-3">
                        <label for="isShow" class="sr-only">Class</label>
                        <select id="isUpdate" class="form-control" name="isShow">
                            <option value="-1" {{ Request::get('isShow', -1) == -1 ? 'selected': '' }}> is show... </option>
                            <option value="0" {{ Request::get('isShow', -1) == 0 ? 'selected': '' }}> True </option>
                            <option value="1" {{ Request::get('isShow', -1) == 1 ? 'selected': '' }}> False </option>
                        </select>
                    </div>

                    <div class="form-group mb-2 mx-sm-3">
                        <input type="submit"class="form-control btn btn-primary" id="SubmitButton" value="Search">
                    </div>
                </form>

                <el-table :data="studentList" style="width: 100%" stripe>
                    <el-table-column type="index" width="150"></el-table-column>
                    <el-table-column prop="name" label="name" width="180"> </el-table-column>
                    <el-table-column prop="class" label="class" width="150"> </el-table-column>
                    <el-table-column prop="created_at" label="create time" width="150"> </el-table-column>

                    <el-table-column label="showing" width="120">

                        <template slot-scope="scope">
                            <div class="form-group mb-2 ">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" :id="'isShowSwitch-' + scope.row.id"
                                           :checked="scope.row.is_show === 0 ? 'checked' : '' " @change="handleShowChange(scope.$index, scope.row.id)">
                                    <label :for="'isShowSwitch-' + scope.row.id" class="custom-control-label"></label>
                                </div>
                            </div>
                        </template>

                    </el-table-column>

                    <el-table-column prop="is_update" label="updating" width="120">
                        <template slot-scope="scope">
                            <div class="form-group mb-2 ">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" :id="'isUpdateSwitch-' + scope.row.id"
                                           :checked="scope.row.is_update === 0 ? 'checked' : '' " @change="handleUpdateChange(scope.$index, scope.row.id)">
                                    <label :for="'isUpdateSwitch-' + scope.row.id" class="custom-control-label" ></label>
                                </div>
                            </div>
                        </template>

                    </el-table-column>

                    <el-table-column label="options" width="180">
                        <template slot-scope="scope">
                            <el-dropdown type="primary">
                                  <span class="el-dropdown-link">
                                    {{ __('Manage') }}<i class="el-icon-arrow-down el-icon--right"></i>
                                  </span>
                                <el-dropdown-menu slot="dropdown">
                                    <a @click="handleEditClass(scope.$index, scope.row)">
                                        <el-dropdown-item>
                                            {{ __('Edit Student Class') }}
                                        </el-dropdown-item>
                                    </a>
                                    <a @click="handleEditAccount(scope.$index, scope.row)">
                                        <el-dropdown-item>
                                            {{ __('Edit Student Account') }}
                                        </el-dropdown-item>
                                    </a>

                                    <a @click="handleDelete(scope.$index, scope.row.id)">
                                        <el-dropdown-item>
                                            {{ __('Delete') }}
                                        </el-dropdown-item>
                                    </a>

                                </el-dropdown-menu>
                            </el-dropdown>
                        </template>
                    </el-table-column>
                </el-table>
                <div style="margin-top: 20px">
                    <el-button @click="addDialog = true">Add One</el-button>
                </div>

                <div class="link justify-content-center">
                    {{ $students->appends(Request::query())->links() }}
                </div>



            </div>
        </div>
    </div>

    <div id="dialog-group">
        <el-dialog title="Add a student" :visible.sync="addDialog" width="40%" :show-close="false">

            <form id="addStudentForm" onsubmit="vue.handleAddSave(); return false}">
                <div class="form-group mb-2">
                    <label for="studentName" class="col-sm-2 col-form-label">Name</label>
                    <input type="text" class="form-control" id="studentName" name="name" placeholder="student name">
                </div>

                <div class="form-group mb-2">
                    <label for="studentName" class="col-sm-2 col-form-label">Class</label>
                    <input type="text" class="form-control" id="studentClass" name="class" placeholder="student class" >
                </div>

                <div class="form-group custom-control-inline">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="isShowSwitch" name="isShowSwitch" checked>
                        <label class="custom-control-label" for="isShowSwitch"> Will show in the plan </label>
                    </div>
                </div>

                <div class="form-group mb-2 ">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="isUpdateSwitch" name="isUpdateSwitch" checked>
                        <label class="custom-control-label" for="isUpdateSwitch"> will update  </label>
                    </div>
                </div>

                <div slot="footer" class="dialog-footer">
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
                    studentList: JSON.parse( '@json($students)' ).data,
                }
            },

            methods: {
                handleAddSave() {
                    const addData = $('#addStudentForm').serializeArray();
                    $('#addFormReset').click();
                    this.addDialog = false;

                    let params = {};
                    for(x in addData) {
                        params[addData[x].name] = addData[x].value;
                    }

                    axios.post( '{{ route('admin.student.index') }}' , params)
                        .then((response) => {
                            this.$message({
                                message: 'Add success',
                                type: 'success',
                            });
                            this.studentList.push({
                                id: response.data.id,
                                name: params.name,
                                created_at: response.data.date,
                                class: params.class,
                                is_update: params.isUpdateSwitch === 'on' ? 0 : 1,
                                is_show: params.isShowSwitch === 'on' ? 0 : 1,
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

                handleEditClass(index, row) {
                    this.$prompt('Please input a the new class name', 'Update Class', {
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        inputPattern: /.+/,
                        inputErrorMessage: 'Nothing input',
                        inputValue: row.class
                    }).then(({value}) => {
                        axios.post('{{ route('admin.student.index') }}' + '/' + row.id, {
                            _method: "PUT",
                            class: value,
                            is_show: row.is_show.toString(),
                            is_update: row.is_update.toString(),
                        }).then((response) => {
                            this.$message({
                                message: 'Update success',
                                type: 'success',
                            });

                            this.studentList[index].class = value
                        }).catch((error) => {
                            this.$message({
                                message: 'Update fail',
                                type: 'error',
                            });
                            console.log(error)
                        });
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Cancel'
                        });
                    });
                },

                handleEditAccount(index, row) {
                    window.open('{{ route('admin.student.index') }}' + '/' + row.id + '/account/', '', {
                        menubar: 0,
                        toolbar: 0,
                    });
                },

                handleUpdateChange(index, id) {
                    let student = this.studentList[index];
                    student.is_update = (student.is_update + 1) % 2;
                    student = Object.assign(student, {_method: "PUT"});

                    axios.post( '{{ route('admin.student.index') }}' + '/' + id,
                        student
                    ).then( (response) => {
                        this.$message({
                            message: 'Update success',
                            type: 'success',
                        });
                        this.studentList[index].is_update = student.is_update;
                    }).catch((error) => {
                        this.$message({
                            message: 'Update fail',
                            type: 'error',
                        });
                        console.log(error)
                    });
                },

                handleShowChange(index, id) {
                    let student = this.studentList[index];
                    student.is_show = (student.is_show + 1) % 2;
                    student = Object.assign(student, {_method: "PUT"});

                    axios.post( '{{ route('admin.student.index') }}' + '/' + id,
                        student
                    ).then( (response) => {
                        this.$message({
                            message: 'Update success',
                            type: 'success',
                        });
                        this.studentList[index].is_show = student.is_show;
                    }).catch((error) => {
                        this.$message({
                            message: 'Update fail',
                            type: 'error',
                        });
                        console.log(error)
                    });
                },

                handleDelete(index, id) {

                    this.$confirm('It will delete the Student, are you sure?', 'Notice', {
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                    }).then(()=> {
                        axios.post( '{{ route('admin.student.index') }}' + '/' + id, {
                            _method: 'Delete',
                        }).then( (response) => {
                            this.$message({
                                message: 'Delete success',
                                type: 'success',
                            });
                            this.studentList.splice(index, 1);
                        }).catch((error) => {
                            this.$message({
                                message: 'Delete fail',
                                type: 'error',
                            });
                            console.log(error)
                        });
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Cancel'
                        });
                    })

                }
            }
        }
    </script>
@endsection


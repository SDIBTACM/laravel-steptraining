<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-18 19:04
 */
?>

@extends('admin.layout')

@php
    $plans = \App\Model\Plan::all();
@endphp

@section('main')
    <div class="container">
        <div class="el-card">
            <div class="el-card__header">
                <div class="title h2">{{ __('Plan List') }}</div>
            </div>
            <div class="el-card__body">
                <el-table :data="planList" style="width: 100%" stripe>
                    <el-table-column type="index" width="180"></el-table-column>
                    <el-table-column prop="name" label="name" width="360"> </el-table-column>
                    <el-table-column prop="created_at" label="create time" width="180"> </el-table-column>
                    <el-table-column  label="options" width="180">
                        <template slot-scope="scope">
                            <el-dropdown type="primary">
                                  <span class="el-dropdown-link">
                                    {{ __('Manage') }}<i class="el-icon-arrow-down el-icon--right"></i>
                                  </span>
                                    <el-dropdown-menu slot="dropdown">
                                        <a @click="handleEdit(scope.$index, scope.row)">
                                            <el-dropdown-item>
                                                {{ __('Edit Plan Name') }}
                                            </el-dropdown-item>
                                        </a>
                                        <a @click="handleEditStudent(scope.$index, scope.row)">
                                            <el-dropdown-item>
                                                {{ __('Edit Student') }}
                                            </el-dropdown-item>
                                        </a>


                                        <a @click="handleEditProblem(scope.$index, scope.row)">
                                            <el-dropdown-item>
                                                {{ __('Edit Problem') }}
                                            </el-dropdown-item>
                                        </a>

                                        <a @click="handleDelete(scope.$index, scope.row)">
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
                    <el-button @click="handleAdd()">Add One</el-button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const data = {
            data: function () {
                return {
                    planList: JSON.parse( '@json($plans)' )
                }
            },

            methods: {
                handleAdd() {
                    this.$prompt('Please input a new Plan Name', 'Input', {
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        inputPattern: /.{1,30}/,
                        inputErrorMessage: 'Nothing input or more than 30 bytes'
                    }).then(({ value }) => {
                        axios.post('{{ route('admin.plan.store') }}',{
                            name: value,
                        }).then( (response) => {
                            this.$message({
                                message: 'Add success',
                                type: 'success',
                            });
                            this.planList.push({name: value, created_at: response.data});
                        }).catch((error) => {
                            this.$message({
                                message: 'Add fail',
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

                handleEdit(index, row) {
                    this.$prompt('Please input a the new plan name', 'Input', {
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        inputPattern: /.+/,
                        inputErrorMessage: 'Nothing input',
                        inputValue: row.name
                    }).then(({ value }) => {
                        axios.post('{{ route('admin.plan.index') }}' + '/' + row.id, {
                            _method: "PUT",
                            name: value,
                        }).then( (response) => {
                            this.$message({
                                message: 'Update success',
                                type: 'success',
                            });

                            this.planList[index].name = value
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


                handleEditStudent(index, row) {
                    window.open('{{ route('admin.plan.index') }}' + '/' + row.id + '/student/', '', {
                        menubar: 0,
                        toolbar: 0,
                    });
                },

                handleEditProblem(index, row) {
                    window.open('{{ route('admin.plan.index') }}' + '/' + row.id + '/problem/', '', {
                        menubar: 0,
                        toolbar: 0,
                    });
                },

                handleDelete(index, row) {
                    this.$confirm('It will delete the Plan, are you sure?', 'Notice', {
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                    }).then(()=> {
                        axios.post( '{{ route('admin.plan.index') }}' + '/' + row.id, {
                            _method: 'Delete',
                        }).then( (response) => {
                            this.$message({
                                message: 'Delete success',
                                type: 'success',
                            });
                            this.planList.splice(index, 1);
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

                },
            }
        }
    </script>
@endsection
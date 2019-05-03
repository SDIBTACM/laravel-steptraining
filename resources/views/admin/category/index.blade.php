@extends('admin.layout')

@php
    $category = \App\Model\Category::all();
@endphp

@section('main')
    <div class="container">
        <div class="el-card">
            <div class="el-card__header">
                <a class="card-title h2"> Category Manager</a>
            </div>

            <div class="el-card__body">
                <div class="justify-content-center">
                    <el-table :data="categoryList" style="width: 100%" stripe>
                        <el-table-column type="index" width="180"></el-table-column>
                        <el-table-column prop="name" label="name" width="360"> </el-table-column>
                        <el-table-column prop="created_at" label="create time" width="270"> </el-table-column>
                        <el-table-column  label="options" width="180">
                            <template slot-scope="scope">
                                <el-button size="mini"
                                           @click="handleEdit(scope.$index, scope.row)">{{ __('Edit') }}</el-button>
                                <el-button
                                        size="mini"
                                        type="danger"
                                        @click="handleDelete(scope.$index, scope.row)">{{ __('Delete') }}</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                    <div style="margin-top: 20px">
                        <el-button @click="handleAdd()">Add One</el-button>
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection


@section('script')
    <script>
        let data = {
            data: function () {
                return {
                    categoryList: JSON.parse(@json($category->toJson())),
                }
            },
            methods: {
                handleAdd() {
                    this.$prompt('Please input a new Category Name', 'Input', {
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        inputPattern: /.+/,
                        inputErrorMessage: 'Nothing input'
                    }).then(({ value }) => {
                        axios.post('{{ route('admin.category.store') }}',{
                            name: value,
                        }).then( (response) => {
                            this.$message({
                                message: 'Add success',
                                type: 'success',
                            });
                            this.categoryList.push({id: response.data.id, name: value, created_at: response.data.date});
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
                   this.$prompt('Please input a the new Category Name', 'Input', {
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        inputPattern: /.+/,
                        inputErrorMessage: 'Nothing input',
                        inputValue: row.name
                    }).then(({ value }) => {
                        axios.post('{{ route('admin.category.index') }}' + '/' + row.id, {
                            _method: "PUT",
                            name: value,
                        }).then( (response) => {
                            this.$message({
                                message: 'Update success',
                                type: 'success',
                            });

                            this.categoryList[index].name = value
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

                handleDelete(index, row) {
                    this.$confirm('It will delete the category, are you sure?', 'Notice', {
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                    }).then(()=> {
                        axios.post( '{{ route('admin.category.index') }}' + '/' + row.id, {
                            _method: 'Delete',
                        }).then( (response) => {
                            this.$message({
                                message: 'Delete success',
                                type: 'success',
                            });
                            this.categoryList.splice(index, 1);
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

<template>
    <div v-if="task!==null">
        <h4>{{task.task_title}}</h4>
        <p>{{task.category.name}} | {{task.created_at | dateformat}}</p>

        <div class="col-md-12 text-right">
            <button class="btn btn-success btn-sm" @click="save()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                </svg>
            </button>
            <button class="btn btn-danger btn-sm" @click="deleteTask(task.id)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
            </button>
        </div>
        <br>
        <div class="card card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Task Title</label>
                            <input type="text" class="form-control" v-model="task.task_title">
                            <span v-if="errors.task_title" :class="['badge badge-danger']">{{ errors.task_title[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select v-model="task.task_category_id" class="form-control">
                                <option value="1">Health</option>
                                <option value="2">Lifestyle</option>
                                <option value="3">Profession</option>
                            </select>
                            <span v-if="errors.task_category_id" :class="['badge badge-danger']">{{ errors.task_category_id[0] }}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Content</label>
                            <textarea type="text" class="form-control" v-model="task.task_content" rows="5"></textarea>
                            <span v-if="errors.task_content" :class="['badge badge-danger']">{{ errors.task_content[0] }}</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div v-else>
        <h4>New Task</h4>
        <div class="col-md-12 text-right">
            <button class="btn btn-success btn-sm" @click="save()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                </svg>
            </button>
            <!-- <button class="btn btn-danger btn-sm" @click="discard()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
            </button> -->
        </div>
        <br>
        <div class="card card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Task Title</label>
                        <input type="text" class="form-control" v-model="new_task.task_title">
                        <span v-if="errors.task_title" :class="['badge badge-danger']">{{ errors.task_title[0] }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Category</label>
                        <select v-model="new_task.task_category_id" class="form-control">
                            <option value="1">Health</option>
                            <option value="2">Lifestyle</option>
                            <option value="3">Profession</option>
                        </select>
                        <span v-if="errors.task_category_id" :class="['badge badge-danger']">{{ errors.task_category_id[0] }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea type="text" class="form-control" v-model="new_task.task_content" rows="5"></textarea>
                        <span v-if="errors.task_content" :class="['badge badge-danger']">{{ errors.task_content[0] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment'
export default {
    props:[
        'task'
    ],
    data(){
        return{
            new_task:{
                task_title:'',
                task_category_id:'',
                task_content:'',
            },
            errors:[],
            changeEvent:false,
        }
    },
    mounted(){
        
    },
    watch:{
        changeEvent:{
            handler(){
                this.errors = [];
                this.new_task = {
                    task_title:'',
                    task_category_id:'',
                    task_content:'',
                }
            },
            deep:true
            
        }
    },
    filters:{
        dateformat(date){
            if(typeof date!=='undefined'){
                return moment(date).format('LL');
            }
        }
    },
    methods:{
        discard(){
            this.new_task = {
                task_title:'',
                task_category_id:'',
                task_content:'',
            }
            this.$parent.getTasks();
        },
        save(){
            swal.fire({
                title:'Loading please wait.',
                didOpen:()=>{
                    swal.showLoading()
                }
            });
            
            let data = [];
            if(this.task!==null){
                data = this.task
            }else{
                data = this.new_task
            }

            axios.post('/task/admod',data).then(
                response=>{
                    if(response.data.status === 'update_success'){
                        Toast.fire({
                            icon:'success',
                            title: "Task Saved.",
                            position: "top-end",
                        });
                        this.errors = [];
                        // this.$parent.getTasks();
                    }
                    else if(response.data.status === 'store_success'){
                        Toast.fire({
                            icon:'success',
                            title: "Task Saved.",
                            position: "top-end",
                        });
                        this.errors = [];
                        this.$parent.getTasks();
                        // this.$parent.selected_task = this.$parent.tasks[0];
                    }else{
                         Toast.fire({
                            icon:'error',
                            title: "Something went wrong..",
                            // html:response.data.message,
                            position: "top-end",
                        });
                        this.errors = response.data.message;
                    }
                    
                }   
            ).catch(
                err=>{
                    Toast.fire({
                        icon:'error',
                        title: "Opss.. something went wrong",
                        // html:response.data.message,
                        position: "top-end",
                    });
                }
            );
        },
        deleteTask(id){
            swal.fire({
                title: 'Are you sure delete task?',
                text: " this won't be able to revert!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    swal.fire({
                        title:'Loading please wait.',
                        didOpen:()=>{
                            swal.showLoading()
                        }
                    });

                    axios.get(`/task/${id}/delete`).then(
                        response=>{
                            Toast.fire({
                                icon:'success',
                                title: "Task Removed.",
                                position: "top-end",
                            });
                            this.$parent.getTasks();
                        }
                    ).catch(
                        err=>{
                            Toast.fire({
                                icon:'error',
                                title: "Opss.. something went wrong",
                                // html:response.data.message,
                                position: "top-end",
                            });
                        }
                    );
                }
            });
        }
    }
}
</script>
<template>
   <div class="container">
       <div class="row">
           <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="d-felx justify-content-end align-items-center">
                    <img class="img-fluid" v-bind:src="'/images/email.jpg'" alt="main_image">
                </div>
            </div>
           <div class="col-md-6 col-sm-6 col-xs-6">
               <div class="card text-black bg-light">
                   <div class="card-header"><center>Ingrese sus datos</center></div>
                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="name" id="name" v-model="fields.name" placeholder="Nombre" />
                                    <div v-if="errors && errors.name" class="alert alert-danger">{{ errors.name[0] }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="phone" id="phone" v-model="fields.phone" placeholder="Teléfono" />
                                    <div v-if="errors && errors.phone" class="alert alert-danger">{{ errors.phone[0] }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email" id="email" v-model="fields.email" placeholder="Email" />
                                    <div v-if="errors && errors.email" class="alert alert-danger">{{ errors.email[0] }}</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" id="subject" v-model="fields.subject" placeholder="Asunto"/>
                                    <div v-if="errors && errors.subject" class="alert alert-danger">{{ errors.subject[0] }}</div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Enviar</button>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div v-if="success" class="alert alert-success mt-3">
                                        Mensaje enviado.
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                fields: {},
                errors: {},
                success: false,
                loaded: true,
            }
        },
        methods: {
            submit() {
                if (this.loaded) {
                    this.loaded = false;
                    this.success = false;
                    this.errors = {};
                    axios.post('/api/clients', this.fields).then(response => {
                        this.fields = {}; //Clear input fields.
                        this.loaded = true;
                        this.success = true;
                    }).catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        },
    },
}

   
   
</script>
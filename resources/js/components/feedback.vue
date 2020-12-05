<template>
    <div>
        <div v-bind:class="message_class">
          {{ message }}
        </div>


    <form action="" @submit="saveFeedback(feedback)">
        <h1 class="p-4 text-center">Feedback Form</h1>
        <div class="row mb-3">
        <div class="col">
          <input type="text" class="form-control" placeholder="First name" v-model="feedback.first_name">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Last name" v-model="feedback.last_name">
        </div>
      </div>

      <div class="form-group">
        <label for="email" class="font-weight-bold">Email address <span class="text-danger font-weight-bold">*</span></label>
        <input type="email" class="form-control" id="email" v-model="feedback.email" aria-describedby="emailHelp" placeholder="Enter email">
      </div>

    <div class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0 font-weight-bold">Feedback type</legend>
          <div class="col-sm-10">
            <div class="form-check">
              <input class="form-check-input" type="radio" v-model="feedback.type" id="comment" value="comment" checked>
              <label class="form-check-label" for="comment">
                Comments
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" v-model="feedback.type" id="suggestion" value="suggestion">
              <label class="form-check-label" for="suggestion">
                Suggestions
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" v-model="feedback.type" id="question" value="question">
              <label class="form-check-label" for="question">
                Questions
              </label>
            </div>
          </div>
        </div>
      </div>


      <div class="form-group mt-3">
          <label for="feedback" class="font-weight-bold">Your feedback <span class="text-danger font-weight-bold">*</span></label>
        <textarea class="form-control" id="feedback" v-model="feedback.feedback" rows="3"></textarea>
      </div>
      <button :disabled="!isValid" class="btn btn-primary" @click.prevent="saveFeedback(feedback)">Send</button>
    </form>
    </div>
</template>
<script>
    export default{
        data() {
            return{
                feedback:{
                    email: '',
                    first_name: '',
                    last_name: '',
                    type: '',
                    feedback: ''
                },
                message: '',
                message_class: ''
            }
        },
        methods: {
            saveFeedback(feedback){
                axios.post(`/feedback`, feedback).then(({data}) => {
                    if (data){
                        this.message = 'Data added'
                        this.message_class = 'alert alert-success'
                    } else {
                        this.message = 'Data not saved'
                        this.message_class = 'alert alert-danger'
                    }

                }).catch(err => {
                    this.message = 'Data invalid'
                    this.message_class = 'alert alert-danger'
                })
                return;
            },
        },
        computed: {
            isValid(){
                return this.feedback.email !== '' && this.feedback.feedback !== ''
            }
        }
    }
</script>

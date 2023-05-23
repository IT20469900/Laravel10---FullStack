
<template>
    <div>
      <h2>Student Registation</h2>
                    <form @submit.prevent="save">

                   <div class="form-group">
                        <label>Student name</label>
                        <input type="text" v-model="Student.name" class="form-control"  placeholder="Student name">
                  </div>
                 <div class="form-group">
                        <label>Student Address</label>
                        <input type="text" v-model="student.address" class="form-control"  placeholder="Student Address">
                                       </div>
            <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" v-model="student.mobile" class="form-control"  placeholder="Mobile">
                                       </div>
                                      <button type="submit" class="btn btn-primary">Save</button>
                    </form>
<h2>Employee View</h2>
      <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Student Name</th>
      <th scope="col">age</th>
      <th scope="col">image</th>
      <th scope="col">status</th>
      <th scope="col">Option</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="student in result" v-bind:key="student.id">
                 <td>{{ student.id }}</td>
          <td>{{ student.name }}</td>
          <td>{{ student.age }}</td>
          <td>{{ student.image }}</td>
          <td>{{ student.status }}</td>
          <td>
            <button type="button" class="btn btn-warning" @click="edit(student)">Edit</button>
            <button type="button" class="btn btn-danger"  @click="remove(student)">Delete</button>
          </td>
        </tr>
      </tbody>
 </table>
     </div>
 </template>

<script>import Vue from 'vue'
import axios from 'axios'
Vue.use(axios)
export default {
  name: 'Student',
  data () {
    return {
      result: {},
      Student: {
        id: '',
        name: '',
        age: '',
        image: '',
        status: ''
      }
    }
  },
  created () {
    this.StudentLoad()
  },
  mounted () {
    console.log('mounted() called.......')
  },
  methods: {
    StudentLoad () {
      var page = 'http://127.0.0.1:8000/api/student'
      axios.get(page)
        .then(
          ({data}) => {
            console.log(data)
            this.result = data
          }
        )
    },

    save () {
      // eslint-disable-next-line eqeqeq
      if (this.student.id == '') {
        this.saveData()
      } else {
        this.updateData()
      }
    },
    saveData () {
      axios.post('http://127.0.0.1:8000/api/save', this.student)
        .then(
          ({data}) => {
            alert('saveddddd')
            this.EtudentLoad()
            this.student.name = ''
            // eslint-disable-next-line no-unused-expressions, no-sequences
            this.student.age = '',
            this.student.image = '',
            this.student.status = ''
            this.id = ''
          }
        )
    },
    edit (student) {
      this.student = student
    },
    updateData () {
      var editrecords = 'http://127.0.0.1:8000/api/update/' + this.student.id
      axios.put(editrecords, this.student)
        .then(
          ({data}) => {
            this.student.name = ''
            // eslint-disable-next-line no-unused-expressions, no-sequences
            this.student.age = '',
            this.student.image = '',
            this.student.status = '',
            this.id = ''
            alert('Updated!!!')
            this.StudentLoad()
          }
        )
    },
    remove (student) {
      var url = `http://127.0.0.1:8000/api/delete/${student.id}`
      axios.delete(url)
      alert('Deleteddd')
      this.StudentLoad()
    }
  }
}

</script>

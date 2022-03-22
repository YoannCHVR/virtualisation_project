<template>
  <h2>Users table</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Password</th>
      <th>More</th>
    </tr>
    <tr>
      <td></td>
      <td><input type="text" v-model="name"></td>
      <td><input type="text" v-model="email"></td>
      <td><input type="text" v-model="pwd"></td>
      <td>
        <input type="button" value="Add" v-if="!editMode" @click="addUser()">
        <input type="button" value="Edit" v-if="editMode" @click="updateUser()">
      </td>
    </tr>
    <tr v-for="(user, index) in users" :key="user.id">
      <td>{{ user.id }}</td>
      <td>{{ user.name }}</td>
      <td>{{ user.email }}</td>
      <td>{{ user.pwd }}</td>
      <td style="width: 100px;">
        <button type="button" name="button" @click="putInfoEditFields(index)">Edit</button>
        <button type="button" name="button" @click="deleteUser(user.id)">Delete</button>
      </td>
    </tr>
  </table>

</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      currentEditUser: {},
      editMode: false,
      users: [],
      name: "",
      email: "",
      pwd: ""
    }
  },
  methods: {
    addUser() {
      if(this.name != "" && this.email != "" && this.pwd != "") {
        axios.post(`http://localhost:8082/action/add_user.php`, {
          name: this.name,
          email: this.email,
          pwd: this.pwd
        }, {
          headers : {
              'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
          }
        })
        .then(response => {
          this.fetchAllUsers()
          console.log(response.data)
          this.resetFields()
        })
        .catch(error => {
          console.error("There was an error!", error)
        });
      }
    },
    updateUser() {
      axios.post(`http://localhost:8082/action/update_user.php`, {
        id: this.currentEditUser.id,
        name: this.name,
        email: this.email,
        pwd: this.pwd
      }, {
        headers : {
            'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
        }
      })
      .then(response => {
        this.fetchAllUsers()
        console.log(response.data)
        this.resetFields()
        this.editMode = false;
      })
      .catch(error => {
        console.error("There was an error!", error)
      });
    },
    deleteUser(id) {
      if (confirm("Are you sure you want to remove this user?")) {
        axios.post(`http://localhost:8082/action/delete_user.php`, { id: id }, {
          headers : {
              'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
          }
        })
        .then(response => {
          this.fetchAllUsers()
          console.log(response.data)
        })
        .catch(error => {
          console.error("There was an error!", error)
        });
      }
    },
    fetchAllUsers() {
      axios.get(`http://localhost:8082/api/get_all_users.php`)
      .then(response => {
        // JSON responses are automatically parsed.
        this.users = response.data
      })
      .catch(e => {
        this.errors.push(e)
      })
    },
    resetFields() {
      this.name = ""
      this.email = ""
      this.pwd = ""
    },
    putInfoEditFields(index) {
      this.editMode = true
      this.currentEditUser = this.users[index]

      this.name = this.currentEditUser.name
      this.email = this.currentEditUser.email
      this.pwd = this.currentEditUser.pwd
    }
  },
  // Fetches posts when the component is created.
  created() {
    this.fetchAllUsers()
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

th {
  background-color: #42b983;
  color: white;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

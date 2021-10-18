<template>
  <div>
    <div class="row">
      <div class="left">
        <div style="margin-right: 20px">
          <p style="text-align: left; margin-left: 30%; font-weight: bolder">Filter Vacancies</p>
        <input type="text" class="search" @click="filter()" placeholder="Job Title, Keyword.." title="Type in a category">
        <button type="submit" class="btn btn-success search">FILTER RESULTS</button>
        </div>
      </div>

      <div class="right">
        <h3 class="header">
          <span>Available Vacancies</span>
          <button type="submit" class="btn btn-success" @click="onEdit()">ADD NEW VACANCY</button>
        </h3><br/>

        <div v-for="item in rows" v-bind:key="item.id">
          <h5>{{ item.title}}</h5>
          <p>{{ item.location}} &nbsp;&nbsp; <span>{{ item.salary}}</span></p>
          <p>{{ item.description}}</p>
          <p><button type="submit" class="btn btn-info">UPDATE VACANCY</button> &nbsp;&nbsp; <span><button type="submit" class="btn btn-danger" @click="deleteVacancy(item.id)">DELETE</button></span></p><br/>
        </div>
        <pagination :data="laravelData" @pagination-change-page="makeCall"></pagination>
      </div>
    </div>

    <div>
      <b-modal v-model="modalShow" ok-title="Submit" @ok="addVacancy" @cancel="cancelAction"  title="Add Vacancy">
        <b-form>
          <b-form-group id="input-group" label="Title" label-for="input">
            <b-form-input
                id="input"
                v-model="form.id"
                required
                hidden
            ></b-form-input>
            <b-form-input
                id="input"
                v-model="form.title"
                placeholder="Enter Title"
                required
            ></b-form-input>
          </b-form-group>
          <b-form-group id="input-group" label="Location" label-for="input">
            <b-form-input
                id="input"
                v-model="form.location"
                placeholder="Enter Location"
                required
            ></b-form-input>
          </b-form-group>
          <b-form-group id="input-group" label="Description" label-for="input">
            <b-form-input
                id="input"
                v-model="form.description"
                placeholder="Enter Description"
                required
            ></b-form-input>
          </b-form-group>
          <b-form-group id="input-group" label="Salary" label-for="input">
            <b-form-input
                id="input"
                v-model="form.salary"
                placeholder="Enter Location"
                required
            ></b-form-input>
          </b-form-group>
        </b-form>
      </b-modal>
    </div>

  </div>
</template>

<script>

import axios from "axios";

export default {
  name: 'HelloWorld',
  props: {
    msg: String
  },
  data: () => ({
    rows: [],
    laravelData: {},
    form: {
      id: null,
      title: '',
      location: '',
      salary: '',
      description: ''
    },
    modalShow: false,
    edit: false
  }),
  methods:{
    cancelAction(){
      return null
    },
    onEdit(){
      this.edit = true;
      this.modalShow = !this.modalShow
    },
    filter(){
      alert('submitted');
    },
    async makeCall(page) {
      if (typeof page === 'undefined') {
        page = 1;
      }
      const config = {
        method: 'get',
        url: this.$endpoint+'/api/list_vacancies?page=' + page
      }
      let res = await axios(config)
      this.laravelData = res.data;
      let chunked = [JSON.parse(JSON.stringify(res.data.data, null, 2))];
      for(let i = 0; i < chunked.length; i++) {
        let array = JSON.parse(JSON.stringify(chunked[i]));
        for(let j = 0; j < array.length; j++) {
          this.rows.push({
            id: array[j].id,
            title:  array[j].title,
            description:  array[j].description,
            location:  array[j].location,
            salary:  array[j].salary
          })
        }
      }
    },
    async deleteVacancy(id) {
      let c = confirm("Are you sure that you want to delete this goods out door?");
      if (c === true) {
        this.form.id = id;
        const response = await axios.post(this.$endpoint+'/api/delete_vacancy', this.form);
        console.log(response.data)
        location.reload();
      } else {
        console.log('cancelled delete action')
      }
    },
  async updateVacancy() {
    const response = await axios.post(this.$endpoint+'/api/update_vacancy', this.form);
    console.log(response.data)
    location.reload();
  },
  async addVacancy() {
    const response = await axios.post(this.$endpoint+'/api/add_vacancy', this.form);
    console.log(response.data)
    location.reload();
  },
},
  created() {
    this.makeCall();
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

* {
  box-sizing: border-box;
}

/* Create a column layout with Flexbox */
.row {
  display: flex;
}

/* Left column (menu) */
.left {
  flex: 25%;
  padding: 15px 0;
  text-align: right;
}

.left h2 {
  padding-left: 8px;
}

/* Right column (page content) */
.right {
  flex: 75%;
  padding: 15px;
  text-align: left;
}

.search {
  width: 70%;
  font-size: 18px;
  padding: 11px;
  border: 1px solid #ddd;
  margin-bottom: 5px;
}

.header{
  display: flex;
  justify-content: space-between;
  margin-right: 30px;
}

</style>

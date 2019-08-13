import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  uri = 'http://localhost:4000/user';
  constructor(private http: HttpClient) {}

  addUser(user_name,user_last_name,user_company){

    const obj = {
      user_name: user_name,
      user_last_name: user_last_name,
      user_company: user_company
    };
    console.log(obj);
    this.http.post(`${this.uri}/add`, obj)
        .subscribe(res => console.log('Done'));
  }
  
getUsers() {
  return this
         .http
         .get(`${this.uri}`);
}
editUser(id) {
  return this
          .http
          .get(`${this.uri}/edit/${id}`);
  }
  updateUser(user_name, user_last_name, user_company, id) {

    const obj = {
      user_name: user_name,
      user_last_name: user_last_name,
      user_company: user_company
      };
    this
      .http
      .post(`${this.uri}/update/${id}`, obj)
      .subscribe(res => console.log('Done'));
  }

  
deleteUser(id) {
  return this
            .http
            .get(`${this.uri}/delete/${id}`);
}

}

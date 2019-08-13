import { Component, OnInit } from '@angular/core';
import { FormGroup,  FormBuilder,  Validators } from '@angular/forms';
import { UserService } from '../../user.service';

@Component({
  selector: 'app-user-add',
  templateUrl: './user-add.component.html',
  styleUrls: ['./user-add.component.css']
})
export class UserAddComponent implements OnInit {


  angForm: FormGroup;
  constructor(private fb: FormBuilder, private bs: UserService) {
    this.createForm();
  }

  createForm() {
    this.angForm = this.fb.group({
      user_name: ['', Validators.required ],
      user_last_name: ['', Validators.required ],
      user_company: ['', Validators.required ]
    });
  }
  addUser(user_name, user_last_name, user_company) {
    this.bs.addUser(user_name, user_last_name, user_company);
  }
  ngOnInit() {
  }

}

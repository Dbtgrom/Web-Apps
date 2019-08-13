
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup,  FormBuilder,  Validators } from '@angular/forms';
import { UserService } from '../../user.service';

@Component({
  selector: 'app-user-edit',
  templateUrl: './user-edit.component.html',
  styleUrls: ['./user-edit.component.css']
})
export class UserEditComponent implements OnInit {
  user: any = {};
  angForm: FormGroup;
  constructor(private route: ActivatedRoute,
    private router: Router,
    private bs: UserService,
    private fb: FormBuilder) {
      this.createForm();
     }
     createForm() {
      this.angForm = this.fb.group({
          user_name: ['', Validators.required ],
          user_last_name: ['', Validators.required ],
          user_company: ['', Validators.required ]
        });
      }
      
   

      ngOnInit() {
        this.route.params.subscribe(params => {
            this.bs.editUser(params['id']).subscribe(res => {
              this.user = res;
          });
        });
      }

      updateUser(user_name, user_last_name, user_company) {
        this.route.params.subscribe(params => {
           this.bs.updateUser(user_name, user_last_name, user_company, params['id']);
           this.router.navigate(['user']);
     });

    }
  }
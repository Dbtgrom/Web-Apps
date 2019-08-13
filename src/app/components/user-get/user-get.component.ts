import { Component, OnInit } from '@angular/core';
import User from '../../User';
import { UserService } from '../../user.service';

@Component({
  selector: 'app-user-get',
  templateUrl: './user-get.component.html',
  styleUrls: ['./user-get.component.css']
})
export class UserGetComponent implements OnInit {
     users: User[];
  constructor(private bs: UserService) { }

  ngOnInit() {
    this.bs
      .getUsers()
      .subscribe((data: User[]) => {
        this.users = data;
    });
  }
  deleteUser(id) {
    this.bs.deleteUser(id).subscribe(res => {
      console.log('Deleted');
    });
  }

}

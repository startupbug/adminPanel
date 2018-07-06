import { Injectable } from '@angular/core';
import { User } from './user.model';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { BaseUrlService } from '../base-url.service';
import { HttpClientModule, HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private baseUrl : BaseUrlService, private router: Router, private httpClient: HttpClient, private toastr : ToastrService) { }

  registerUser(user : User)
  {
      this.httpClient.post(this.baseUrl.url()+'user-register', user).subscribe(
       res => {
           localStorage.setItem('currentUser', JSON.stringify(res));
           this.router.navigate(['/dashboard']);
           this.toastr.success('New Record Added Successfully','User Register');
       },
       err => {
         this.toastr.error('Email Address and Password in Invalid','User');
       }
     );
  }

  loginUser(user : User)
  {
      this.httpClient.post(this.baseUrl.url()+'user-login', user)
      .subscribe(
       res => {
         if(res == "unauthorize"){
           this.toastr.error('Email Address and Password in Invalid','User');
         }
         else
         {
           localStorage.setItem('currentUser', JSON.stringify(res));
           this.router.navigate(['/dashboard']);
           this.toastr.success('Login Successfully','User');
         }

       },
       err => {
         this.toastr.error('Email Address and Password in Invalid','User');
       }
     );
  }

}

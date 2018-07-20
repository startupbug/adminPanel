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
         if(res['success']){
           // console.log(JSON.stringify(res));
           localStorage.setItem('currentUser', JSON.stringify(res['user']));
           localStorage.setItem('token', res['token']);
           this.router.navigate(['/dashboard']);
           this.toastr.success(res['message'],'User Register');
         }
         else{
           this.toastr.error(res['message'],'User Register');
         }
       },
       err => {
         this.toastr.error('Email Address and Password in Invalid','User Register');
       }
     );
  }

  loginUser(user : User)
  {
      this.httpClient.post(this.baseUrl.url()+'user-login', user)
      .subscribe(
       res => {
         if(res['success']){
           localStorage.setItem('currentUser', JSON.stringify(res['user']));
           localStorage.setItem('token', res['token']);
           this.router.navigate(['/dashboard']);
           this.toastr.success(res['message'],'User');
         }
         else{
           this.toastr.error(res['message'],'User');
         }
       },
       err => {
         this.toastr.error('Email Address and Password in Invalid','User');
       }
     );
  }

}
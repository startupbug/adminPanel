import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';
import { Observable } from 'rxjs';
import { Router } from '@angular/router';

@Injectable()
export class AuthguardGuard implements CanActivate {

    constructor(private router: Router){}

    canActivate(
      next: ActivatedRouteSnapshot,
      state: RouterStateSnapshot):boolean {
       console.log(localStorage.getItem('currentUser'));
       if (localStorage.getItem('currentUser')) {
         return true;
       }
       else{
         this.router.navigate(['/login']);
         return false;
       }

    }
  }

import { Injectable } from '@angular/core';
import { Role } from './role.model';
import { BaseUrlService } from '../base-url.service';

import { HttpClientModule, HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class RoleService {

  constructor(private baseUrl : BaseUrlService, private httpClient: HttpClient) { }

  roleData() {
    return this.httpClient.get(this.baseUrl.url()+'roles');
  }

  roleSave(role : Role) {
    return this.httpClient.post(this.baseUrl.url()+'roles/save', role);
  }

  roleUpdate(role : Role) {
    return this.httpClient.post(this.baseUrl.url()+'roles/update', role);
  }

  roleDelete(role : Role) {
    return this.httpClient.post(this.baseUrl.url()+'roles/delete', role);
  }


}

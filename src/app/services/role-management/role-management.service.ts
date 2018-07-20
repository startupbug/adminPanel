import { Injectable } from '@angular/core';
import { RoleManagement } from './role-management.model';
import { BaseUrlService } from '../base-url.service';

import { HttpClientModule, HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class RoleManagementService {

  constructor(private baseUrl : BaseUrlService, private httpClient: HttpClient) { }

  roleManagemenData() {
    return this.httpClient.get(this.baseUrl.url()+'role_permission');
  }

  roleManagemenSave(roleManagement : RoleManagement) {
    return this.httpClient.post(this.baseUrl.url()+'role_permission/save', roleManagement);
  }

  roleManagementDelete(roleManagement : RoleManagement) {
    return this.httpClient.post(this.baseUrl.url()+'roles/delete', roleManagement);
  }

  rolePermissionDelete(roleManagement : RoleManagement) {
    console.log(roleManagement);
    return this.httpClient.post(this.baseUrl.url()+'role_permission/delete', roleManagement);
  }
}

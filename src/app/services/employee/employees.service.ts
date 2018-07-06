import { Injectable } from '@angular/core';
import { Employee } from './employee.model';
import { BaseUrlService } from '../base-url.service';

import { HttpClientModule, HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class EmployeesService {

  constructor(private baseUrl : BaseUrlService, private httpClient: HttpClient) { }

  employeeData() {
    return this.httpClient.get(this.baseUrl.url()+'posts_all');
  }
  
  employeeSave(employee : Employee) {
    return this.httpClient.post(this.baseUrl.url()+'post', employee);
  }

}

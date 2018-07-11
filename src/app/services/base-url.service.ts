import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class BaseUrlService {

  constructor() { }

  url(){
    return "http://128.10.1.167/angular_template/api/public/api/";
    // return "http://site.startupbug.net:6888/api/v1/public/api/";
  }
}

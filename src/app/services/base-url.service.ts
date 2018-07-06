import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class BaseUrlService {

  constructor() { }

  url(){
    return "http://site.startupbug.net:6888/api/v1/public/api/";
  }
}

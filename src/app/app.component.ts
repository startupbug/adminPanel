import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'app';
  myObject = {
   gender: 'male',
   age: 33,
   location: 'USA'
  };
  myArr = ['him','hers','yours','theirs'];
}

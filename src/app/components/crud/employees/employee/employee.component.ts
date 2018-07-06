import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { EmployeesService } from '../../../../services/employee/employees.service';

@Component({
  selector: 'app-employee',
  templateUrl: './employee.component.html',
  styleUrls: ['./employee.component.css']
})
export class EmployeeComponent implements OnInit {

  employeeList : any = [];
  employeeForm: FormGroup;
  titleAlert:string = 'This field is required';

  constructor(private employeesService : EmployeesService, private formBuilder: FormBuilder, private toastr : ToastrService) { }

  ngOnInit() {
    this.employeeForm = this.formBuilder.group({
      'title' : [null, Validators.required],
      'message' : [null, Validators.required],
      'image' : [null, Validators.required]
    });
    this.getData();
  }

  getData() {
    this.employeesService.employeeData().subscribe((x: any) => {
       this.employeeList = x['posts'];
    });
  }

  selectFile(event) {
    let reader = new FileReader();
    if(event.target.files && event.target.files.length > 0) {
      let file = event.target.files[0];
      reader.readAsDataURL(file);
      reader.onload = () => {
        this.employeeForm.get('image').setValue({
          filename: file.name,
          filetype: file.type,
          value: reader.result.split(',')[1]
        })
      };
    }
  }
  onSubmit(value) {
    const formModel = this.employeeForm.value;
    this.employeesService.employeeSave(formModel).subscribe(
       res => {
         if(res){
           this.toastr.success('New Record Added Successfully','Employee Register');
           // Form Reset And  Refresh Data
           this.employeeForm.reset();
           this.getData();
         }
       },
       err => {
         this.toastr.error('Employee in Invalid');
       }
    );
  }

}

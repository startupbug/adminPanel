import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { RoleService } from '../../../../services/role/role.service';
declare var $;

@Component({
  selector: 'app-role',
  templateUrl: './role.component.html',
  styleUrls: ['./role.component.css']
})
export class RoleComponent implements OnInit {

  roleList : any = [];
  roleForm: FormGroup;
  titleAlert:string = 'This field is required';

  constructor(private roleService : RoleService, private formBuilder: FormBuilder, private toastr : ToastrService) { }

  ngOnInit() {
    this.roleForm = this.formBuilder.group({
      'id' : [null],
      'name' : [null, Validators.required],
      'display_name' : [null, Validators.required],
      'description' : [null]
    });
    this.getData();

    $('#example2').DataTable(); 
  }

  getData() {
    this.roleService.roleData().subscribe((x: any) => {
       this.roleList = x['roles'];
    });
  }

  onSubmit(value) {
    if(value.value['id'] == null){
      this.roleService.roleSave(value.value).subscribe(
         res => {
           if(res['success']){
             this.toastr.success(res['message']);
             // Form Reset And  Refresh Data
             this.roleForm.reset();
             this.getData();
           }
           else{
             this.toastr.error(res['message']);
           }
         },
         err => {
           this.toastr.error('Not Response');
         }
      );
    }
    else{
      this.roleService.roleUpdate(value.value).subscribe(
        res => {
          if(res['success']){
            this.toastr.success(res['message']);
            // Form Reset And  Refresh Data
            this.roleForm.reset();
            this.getData();
          }
          else{
            this.toastr.error(res['message']);
          }
        },
        err => {
          this.toastr.error('Not Response');
        }
      );
    }
  }

  onEdit(value) {
    this.roleForm.setValue(value);
  }

  onReset() {
    this.roleForm.reset();
  }

  onDelete(value) {
    this.roleService.roleDelete(value).subscribe(
      res => {
        console.log(res);
        if(res['success']){
          this.toastr.error(res['message']);
          this.getData();
        }
        else{
          this.toastr.error(res['message']);
        }
      },
      err => {
        this.toastr.error('Not Response');
      }
    );
  }

}

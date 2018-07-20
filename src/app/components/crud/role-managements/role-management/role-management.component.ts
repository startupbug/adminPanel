import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { RoleManagementService } from '../../../../services/role-management/role-management.service';
declare var $;
@Component({
  selector: 'app-role-management',
  templateUrl: './role-management.component.html',
  styleUrls: ['./role-management.component.css']
})

export class RoleManagementComponent implements OnInit {

    permissionsList_id : any = [];
    permissionsList : any = [];
    rolesList : any = [];
    role_management_form: FormGroup;
    objects : any;

    constructor(private roleManagementService : RoleManagementService, private formBuilder: FormBuilder, private toastr : ToastrService) { }

    ngOnInit() {
      this.role_management_form = this.formBuilder.group({
        'role_id' : [null],
        'permission_id' : [null, Validators.required]
      });

      this.getData();

      $('#example2').DataTable();
    }


    getData() {
      this.roleManagementService.roleManagemenData().subscribe((x: any) => {
         this.rolesList = x['data']['roles'];
         this.permissionsList = x['data']['permissions'];
      });
    }

    onSubmit(value, id) {
      this.objects = {
        'role_id' : id,
        'permission_id' : value.value.permission_id
      }
      this.roleManagementService.roleManagemenSave(this.objects).subscribe(
        res => {
          if(res['success']){
            this.toastr.success(res['message']);
            // Form Reset And  Refresh Data
            this.role_management_form.reset();
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

    onDelete(value) {

      this.roleManagementService.roleManagementDelete(value).subscribe(
        res => {
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

    onPermission(value){
      this.permissionsList_id = value;
    }

    onPermissionDelete(value) {
      this.roleManagementService.rolePermissionDelete(value).subscribe(
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

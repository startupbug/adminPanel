// Lib Imports
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { RouterModule, Routes } from '@angular/router';
import { CommonModule } from '@angular/common';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ToastrModule } from 'ngx-toastr';

// Components
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { RegisterComponent } from './components/register/register.component';
import { SiginComponent } from './components/sigin/sigin.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';

import { EmployeesComponent } from './components/crud/employees/employees.component';
import { EmployeeComponent } from './components/crud/employees/employee/employee.component';

// Service
import { BaseUrlService } from './services/base-url.service';
import { UserService } from './services/user/user.service';
import { EmployeesService } from './services/employee/employees.service';

// Guard
import { AuthguardGuard } from './guards/authguard.guard';


const appRoutes: Routes =
[
  {
    path: 'register',
    component: RegisterComponent
  },
  {
    path: 'login',
    component: SiginComponent,
    data: { title: 'Login' }
  },
  {
    path: 'dashboard',
    canActivate: [AuthguardGuard],
    component: DashboardComponent
  },
  {
    path: 'employee',
    canActivate: [AuthguardGuard],
    component: EmployeesComponent
  },
  { path: '',
    redirectTo: '/login',
    pathMatch: 'full'
  },
  {
    path: '**',
    component: PageNotFoundComponent
  }
];

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    DashboardComponent,
    SiginComponent,
    PageNotFoundComponent,
    RegisterComponent,
    EmployeesComponent,
    EmployeeComponent
  ],
  imports: [
    CommonModule,
    BrowserModule,
    HttpClientModule,
    HttpModule,
    FormsModule,
    ReactiveFormsModule,
    BrowserAnimationsModule, // required animations module
    ToastrModule.forRoot(), // ToastrModule added
    RouterModule.forRoot(
      appRoutes,
      { enableTracing: true }
    )
  ],
  providers: [
    BaseUrlService,
    UserService,
    EmployeesService,
    AuthguardGuard
  ],
  bootstrap: [AppComponent]
})

export class AppModule { }

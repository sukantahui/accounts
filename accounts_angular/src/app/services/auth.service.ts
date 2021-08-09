import { Injectable } from '@angular/core';
import {HttpClient, HttpErrorResponse} from '@angular/common/http';
import {catchError, tap} from 'rxjs/operators';
import {BehaviorSubject, Subject, throwError} from 'rxjs';
import {User} from '../models/user.model';
import {Router} from '@angular/router';
// global.ts file is created in shared folder to store all global variables.
import {GlobalVariable} from '../shared/global';

export interface AuthResponseData {
  success: number;
  data:{
    user: {uniqueId: number, userName: string,  userTypeId: number, userTypeName: string};
    token: string;
  };
  message: string;
}

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  user = new BehaviorSubject<User>(null);

  constructor(private http: HttpClient, private router: Router) { }
  isAuthenticated(){

    if (this.user.value){
      return true;
    }else{
      return false;
    }
  }
  autoLogin(){
    const userData: {id: number, personName: string, _authKey: string, personTypeId: number} = JSON.parse(localStorage.getItem('user'));
    if (!userData){
      return;
    }
    const loadedUser = new User(userData.id, userData.personName, userData._authKey, userData.personTypeId);
    if (loadedUser.authKey){
      this.user.next(loadedUser);
      //  if (loadedUser.isOwner){
      //   this.router.navigate(['/owner']);
      // }
    }
  }
  login(loginData){
    return this.http.post<AuthResponseData>(GlobalVariable.BASE_API_URL + '/login', loginData)
      .pipe(catchError(this.handleError), tap(resData => {
        // tslint:disable-next-line:max-line-length
        if (resData.success === 1){
            const user = new User(resData.data.user.uniqueId,
              resData.data.user.userName,
              resData.data.token,
              resData.data.user.userTypeId);
            this.user.next(user); // here two user is used one is user and another user is subject of rxjs
            localStorage.setItem('user', JSON.stringify(user));
          }
      }));  // this.handleError is a method created by me
  }

  private handleError(errorResponse: HttpErrorResponse){
    return throwError(errorResponse.error.message);
  }

  logout(){
    this.user.next(null);
    localStorage.removeItem('user');
    this.router.navigate(['/auth']);
    location.reload();
    this.router.navigate(['/auth']);
  }


}

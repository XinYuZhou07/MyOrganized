//import java.util.Calendar;

public class User{
    private String name;
    private String surname;
    private String username;
    private String email;
    //private String phoneNumber;
    private String password;
    //private Calendar birthDate;
    //private boolean onlineStatus;

    public User(String name, String surname, String username, String email, String password, String phoneNumber){
        this.name=name;
        this.surname=surname;
    //    this.phoneNumber=phoneNumber;
        this.username=username;
        this.email=email;
        this.password=password;
        //this.birthDate=birthDate;
    }
    public User(String usrname, String psw){
        this.username = usrname;
        this.password = psw;
    }

    public User() {
    }

    public String getName() {
        return name;
    }
    public void setName(String name) {
        this.name = name;
    }
    public String getSurname() {
        return surname;
    }
    public void setSurname(String surname) {
        this.surname = surname;
    }
    public String getUsername(){
        return username;
    }
    public void setUsername(String username){
        this.username=username;
    }
    public String getEmail() {
        return email;
    }
    public void setEmail(String email){
        this.email=email;
    }
    public String getPassword(){
        return password;
    }
    public void setPassword(String password){
        this.password=password;
    }
    /* public Calendar getBirthDate(){
        return birthDate;
    }
    public void setBirthDate(Calendar birthDate){
        this.birthDate=birthDate;
    } */
    /* public boolean isOnlineStatus(){
        return onlineStatus;
    }
    public void setOnlineStatus(boolean onlineStatus){
        this.onlineStatus=onlineStatus;
    } */
    /* public String getPhoneNumber(){
        return phoneNumber;
    }
    public void setPhoneNumber(String phoneNumber){
        this.phoneNumber=phoneNumber;
    } */
    @Override
    public String toString(){
        return "User{" +
                "username='" + username + '\'' +
                ", name='" + name + '\'' +
                ", surname='" + surname + '\'' +
                ", email='" + email + '\'' +
                ", password='" + password + '\'' +
/*                 ", birthDate=" + birthDate +
 *//*                 ", onlineStatus=" + onlineStatus +
 *///                ", phoneNumber='" + phoneNumber + '\'' +
                '}';
    }
}
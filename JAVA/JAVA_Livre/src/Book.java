import java.util.ArrayList;

public class Book {

    // ----------- ATTRIBUTE
    private int idBook;
    private String title;
    private String resume;
    private String thumbnail;
    private String year;

    private ArrayList<String> listGenre = new ArrayList<String>();
    private ArrayList<String> listAuthor = new ArrayList<String>();
    private ArrayList<String> listUser = new ArrayList<String>();

    @Override
    public String toString() {
        return "Book{" +
                "idBook=" + idBook +
                ", title='" + title + '\'' +
                ", resume='" + resume + '\'' +
                ", thumbnail='" + thumbnail + '\'' +
                ", year='" + year + '\'' +
                ", listGenre=" + listGenre +
                ", listAuthor=" + listAuthor +
                ", listUser=" + listUser +
                '}';
    }


    // ----------- GETTER SETTER

    public int getBook() {
        return idBook;
    }

    public ArrayList<String> getListGenre() {
        return listGenre;
    }

    public void setListGenre(ArrayList<String> listIdGenre) {
        this.listGenre = listIdGenre;
    }

    public ArrayList<String> getListAuthor() {
        return listAuthor;
    }

    public void setListAuthor(ArrayList<String> listIdAuthor) {
        this.listAuthor = listIdAuthor;
    }

    public ArrayList<String> getListUser() {
        return listUser;
    }

    public void setListUser(ArrayList<String> listIdUser) {
        this.listUser = listIdUser;
    }

    public void setIdBook(int idBook) {
        this.idBook = idBook;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getResume() {
        return resume;
    }

    public void setResume(String resume) {
        this.resume = resume;
    }

    public String getThumbnail() {
        return thumbnail;
    }

    public void setThumbnail(String thumbnail) {
        this.thumbnail = thumbnail;
    }

    public String getYear() {
        return year;
    }

    public void setYear(String year) {
        this.year = year;
    }



    // ----------- GETTER SETTER
    public Book(int idBook, String title, String resume, String thumbnail, String year) {
        this.idBook = idBook;
        this.title = title;
        this.resume = resume;
        this.thumbnail = thumbnail;
        this.year = year;
    }

    public Book(){
    }



}

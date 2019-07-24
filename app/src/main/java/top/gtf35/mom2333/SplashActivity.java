package top.gtf35.mom2333;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.RequiresApi;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.widget.Toast;

public class SplashActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //setContentView(R.layout.activity_splash);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            checkRermission();
        } else {
            goMain();
        }
    }



    private boolean getWriteStoragePremissionStatues(){
        return ContextCompat.checkSelfPermission(SplashActivity.this, Manifest.permission.WRITE_EXTERNAL_STORAGE)
                == PackageManager.PERMISSION_GRANTED;
    }

    private boolean getGPSPremissionStatues(){
        return ContextCompat.checkSelfPermission(SplashActivity.this, Manifest.permission.ACCESS_FINE_LOCATION)
                == PackageManager.PERMISSION_GRANTED;
    }

    @RequiresApi(api = Build.VERSION_CODES.M)
    private void checkRermission(){
        if (getGPSPremissionStatues()&&getWriteStoragePremissionStatues()) {
            goMain();
        } else {
            requestPermissions(new String[]{Manifest.permission.ACCESS_FINE_LOCATION, Manifest.permission.WRITE_EXTERNAL_STORAGE}, 1);
        }
    }



    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        if (grantResults.length > 0) {//grantResults 数组中存放的是授权结果
            if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {//同意授权
                goMain();
            }else {//用户拒绝授权
                //可以简单提示用户
                Toast.makeText(SplashActivity.this, "没有授权继续操作", Toast.LENGTH_SHORT).show();
                finish();
            }
        }
    }

    private void goMain(){
        startActivity(new Intent(this, MomActivity.class));
        finish();
    }

}
